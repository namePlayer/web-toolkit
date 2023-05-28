<?php

declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\TwoFactor;
use App\Model\Authentication\TwoFactorType;
use App\Model\Mail\MailType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AddTwoFactorController
{

    public function __construct(
        private Engine          $template,
        private AccountService  $accountService,
        private SecurityService $securityService,
        private MailerService   $mailerService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if ($request->getMethod() !== "POST" | !isset($_POST['addTwoFactorModalSubmit']) || !isset($_POST['addTwoFactorModalName'])) {
            return new RedirectResponse('/account/security');
        }

        $twoFactor = new TwoFactor();
        $twoFactor->setType(TwoFactorType::TOTP_ID);
        $twoFactor->setAccount($account->getId());
        $twoFactor->setToken($_POST['twoFactorToken'] ?? $this->securityService->generateTOTPSecret());
        $twoFactor->setName($_POST['addTwoFactorModalName']);

        if (isset($_POST['addTwoFactorTotpTFACode'])) {
            if ($this->securityService->add($twoFactor, (int)$_POST['addTwoFactorTotpTFACode'])) {
                $this->mailerService->configureMail(
                    $account->getEmail(),
                    'Neuer zweiter Faktor hinterlegt',
                    MailType::ADDED_TWO_FACTOR_MAIL_ID,
                    ['accountName' => $account->getName()],
                    $account->getId()
                )->send();
                return new RedirectResponse('/account/security');
            }
        }

        return new HtmlResponse(
            $this->template->render(
                'account/addTwoFactor',
                [
                    'totpQrCode' => $this->securityService->generateTOTPQrCodeBase64(
                        $this->securityService->generateTOTPFromSecret($twoFactor->getSecret(), $twoFactor->getName()), 0
                    ),
                    'totpToken' => $twoFactor->getSecret(),
                    'twoFactorName' => $twoFactor->getName()
                ]
            ));

    }

}
