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

        return new HtmlResponse(
            $this->template->render('account/security',
            [
                'totpToken' => $this->securityService->generateTOTPSecret()
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

    }

}