<?php

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\PasswordService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService,
        private readonly PasswordService $passwordService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if($request->getMethod() === "POST")
        {
            $this->login($request);
        }

        return new HtmlResponse($this->template->render('authentication/login'));
    }

    public function login(ServerRequestInterface $request)
    {

        if(isset($_POST['email'], $_POST['password']))
        {

            $account = new Account();
            $account->setEmail($_POST['email']);
            $account->setPassword($_POST['password']);

            $login = $this->accountService->findAccountByEmail($account->getEmail());
            if($login === FALSE)
            {
                MESSAGES->add('danger', 'login-wrong-combination');
                return;
            }

            $account->setId($login['id']);
            $account->setActive($login['active']);
            $account->setSetupComplete($login['setupComplete']);

            if($account->isActive() === FALSE)
            {
                MESSAGES->add('danger', 'login-account-disabled');
                return;
            }

            if($this->passwordService->verifyPassword($account->getPassword(), $login['password']))
            {
                MESSAGES->add('success', 'login-account-successful');
                $this->accountService->updateLastUserLogin($account);
                if(!$account->isSetupComplete()) {
                    header("Location: /authentication/setup");
                    return;
                }
                header("Location: /overview");
                return;
            }

            MESSAGES->add('danger', 'login-wrong-combination');
            return;

        }

    }

}