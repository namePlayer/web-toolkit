<?php

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\TwoFactor;
use App\Model\Authentication\TwoFactorType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SecurityController
{

    public function __construct(
        private readonly Engine $template,
        private AccountService $accountService,
        private SecurityService $securityService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if($request->getMethod() === 'POST')
        {
            $this->create($account);
        }

        $otp = $this->securityService->generateTOTPSecret();

        return new HtmlResponse(
            $this->template->render('account/security',
            [
                'account' => $this->accountService->findAccountById($account->getId()),
                'totpToken' => $otp,
                'totpQrCode' => $this->securityService->generateTOTPQrCodeBase64($this->securityService->generateTOTPFromSecret($otp)),
                'twoFactors' => $this->securityService->getTwoFactorByAccountID($account->getId())
            ]));
    }

    public function create(Account $account): void
    {

        if(isset($_POST['addTwoFactorModalSubmit'], $_POST['addTwoFactorModalTFAToken'], $_POST['addTwoFactorModalName'], $_POST['addTwoFactorModalTFACode']))
        {
            $twoFactor = new TwoFactor();
            $twoFactor->setAccount($account->getId());
            $twoFactor->setType(TwoFactorType::TOTP_ID);
            $twoFactor->setName($_POST['addTwoFactorModalName']);
            $twoFactor->setToken($_POST['addTwoFactorModalTFAToken']);

            $this->securityService->add($twoFactor, $_POST['addTwoFactorModalTFACode']);
        }

        if(isset($_POST['securityBasicSettingsSave']))
        {

            $this->accountService->setSendLoginEmail($account->getId(), isset($_POST['sendLoginEmailCheck']));

            MESSAGES->add('success', 'account-settings-security-update-success');

        }

    }

}