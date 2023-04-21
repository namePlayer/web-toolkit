<?php declare(strict_types=1);

namespace App\Service\Account;

use App\Model\Authentication\TwoFactor;
use App\Service\Authentication\AccountService;
use App\Software;
use App\Table\Account\TwoFactorTable;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\SvgWriter;
use OTPHP\TOTP;
use ParagonIE\ConstantTime\Base32;

readonly class SecurityService
{

    public function __construct(
        private AccountService $accountService,
        private TwoFactorTable $twoFactorTable
    )
    {
    }

    public function add(TwoFactor $twoFactor, int $code): void
    {
        if($this->accountService->findAccountById($twoFactor->getAccount()) === FALSE)
        {
            return;
        }

        $totp = $this->generateTOTPFromSecret($twoFactor->getSecret());

        if($this->verifyTOTPBySecret($twoFactor->getSecret(), (string)$code) === FALSE)
        {
            MESSAGES->add('danger', 'account-settings-security-two-factor-failed-code-invalid');
            return;
        }

        if($this->twoFactorTable->insert($twoFactor) === FALSE)
        {
            MESSAGES->add('danger', 'account-settings-security-two-factor-failed-unk');
            return;
        }

        MESSAGES->add('success', 'Der 2. Faktor wurde erfolgreich hinterlegt');
    }

    public function accountHasTwoFactorEnabled(int $account): bool
    {
        return !empty($this->getTwoFactorByAccountID($account));
    }

    public function verifyAccountTwoFactor(int $account, string $code): bool
    {
        foreach ($this->getTwoFactorByAccountID($account) as $twoFactor)
        {
            if($this->verifyTOTPBySecret($twoFactor['secret'], $code))
            {
                return true;
            }
        }

        return false;
    }

    public function verifyTOTPBySecret(string $secret, string $code): bool
    {
        $totp = $this->generateTOTPFromSecret($secret);
        return $totp->verify($code, null, (int)$_ENV['MFA_TOTP_TIME_WINDOW'] ?? 5);
    }

    public function getTwoFactorByAccountID(int $account): array|false
    {
        return $this->twoFactorTable->findAllTwoFactorsByAccount($account);
    }

    public function generateTOTPSecret(): string
    {
        return trim(Base32::encodeUpper(random_bytes(isset($_ENV['MFA_TOTP_GEN_BITS']) ? (int)$_ENV['MFA_TOTP_GEN_BITS'] : 10)), '=');
    }

    public function generateTOTPQrCodeBase64(TOTP $totp): string
    {

        $qrcode = Builder::create()
            ->writer(new SvgWriter())
            ->data($totp->getProvisioningUri())
            ->size(300)
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->margin(15)
            ->labelText('2 Factor Auth')
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();

        return $qrcode->getString();

    }

    public function generateTOTPFromSecret(string $secret, string $label = ''): TOTP
    {
        $totp = TOTP::createFromSecret($secret);
        $totp->setDigits((int)$_ENV['MFA_TOTP_DIGITS'] ?? 6);
        $totp->setPeriod((int)$_ENV['MFA_TOTP_PERIOD'] ?? 30);
        $totp->setIssuer((string)$_ENV['MFA_ISSUER'] ?? 'Web-Toolkit');
        $totp->setLabel(empty($label) ? $_ENV['SOFTWARE_TITLE'] : $label);
        return $totp;
    }

}
