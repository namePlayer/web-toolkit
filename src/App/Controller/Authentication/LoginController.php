<?php

declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\PasswordService;
use App\Software;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class LoginController
{

    public function __construct(
        private Engine $template,
        private AccountService $accountService,
        private PasswordService $passwordService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === "POST") {
            $login = $this->login($request);
            if ($login instanceof ResponseInterface) {
                return $login;
            }
        }

        return new HtmlResponse($this->template->render('authentication/login'));
    }

    public function login(ServerRequestInterface $request): ResponseInterface|false
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $account = new Account();
            $account->setEmail($_POST['email']);
            $account->setPassword($_POST['password']);

            $login = $this->accountService->findAccountByEmail($account->getEmail());
            if ($login === false) {
                MESSAGES->add('danger', 'login-wrong-combination');
                return false;
            }

            $account->setId($login['id']);
            $account->setActive((int)$login['active'] === 1);
            $account->setSetupComplete((int)$login['setupComplete'] === 1);

            if ($account->isActive() === false) {
                MESSAGES->add('danger', 'login-account-disabled');
                return false;
            }

            if ($this->passwordService->verifyPassword($account->getPassword(), $login['password'])) {
                MESSAGES->add('success', 'login-account-successful');
                $this->accountService->updateLastUserLogin($account);
                $_SESSION[Software::SESSION_USERID_NAME] = $account->getId();
                if (!$account->isSetupComplete()) {
                    return new RedirectResponse("/authentication/setup");
                }
                if (!empty($_GET['redirect'])) {
                    return new RedirectResponse($_GET['redirect']);
                }
                return new RedirectResponse("/overview");
            }

            MESSAGES->add('danger', 'login-wrong-combination');
        }

        return false;
    }

}
