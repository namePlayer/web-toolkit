<?php

namespace App\Service\Account;

use App\Model\Authentication\TwoFactor;
use App\Service\Authentication\AccountService;
use App\Table\Account\TwoFactorTable;
use OTPHP\TOTP;

class SecurityService
{

    public function __construct(
        private readonly AccountService $accountService,
        private readonly TwoFactorTable $twoFactorTable
    )
    {
    }

    public function add(TwoFactor $twoFactor, int $code): void
    {
        if($this->accountService->findAccountById($twoFactor->getAccount()) === FALSE)
        {
            return;
        }

        $twoFactor->setToken($this->generateTOTPSecret());
        $totp = $this->generateTOTPFromSecret($twoFactor->getSecret());

        if($totp->now() !== (string)$code)
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

    public function generateTOTPSecret(): string
    {
        return trim(\ParagonIE\ConstantTime\Base32::encodeUpper(random_bytes($_ENV['MFA_TOTP_GEN_BITS'] ?? 10)), '=');
    }

    private function generateTOTPFromSecret(string $secret): TOTP
    {
        return TOTP::createFromSecret($secret);
    }

}