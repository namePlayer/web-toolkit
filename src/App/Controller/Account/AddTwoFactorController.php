<?php

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\TwoFactor;
use App\Model\Authentication\TwoFactorType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddTwoFactorController
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

        if($request->getMethod() !== "POST" | !isset($_POST['addTwoFactorModalSubmit']) || !isset($_POST['addTwoFactorModalName']))
        {
            return new RedirectResponse('/account/security');
        }

        $twoFactor = new TwoFactor();
        $twoFactor->setType(TwoFactorType::TOTP_ID);
        $twoFactor->setAccount($account->getId());
        $twoFactor->setToken($_POST['twoFactorToken'] ?? $this->securityService->generateTOTPSecret());
        $twoFactor->setName($_POST['addTwoFactorModalName']);

        if(isset($_POST['addTwoFactorTotpTFACode']))
        {
            if($this->securityService->add($twoFactor, $_POST['addTwoFactorTotpTFACode']))
            {
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