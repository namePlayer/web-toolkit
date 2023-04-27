<?php

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\TokenService;
use App\Software;
use DateTime;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class ActivateAccountController
{

    public function __construct(
        private Engine         $engine,
        private TokenService   $tokenService,
        private AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($_GET['token'])) {
            return new RedirectResponse('/authentication/login');
        }

        $token = $this->tokenService->getByToken($_GET['token']);
        if ($token === false) {
            return new RedirectResponse('/authentication/login');
        }

        if ($token->getExpiry() < new DateTime()) {
            return new HtmlResponse('Link has expired');
        }

        $accountData = $this->accountService->findAccountById($token->getAccount());

        if ($accountData === false) {
            return new RedirectResponse('/authentication/login');
        }

        $account = new Account();
        $account->setId($accountData['id']);
        $account->setSetupComplete($accountData['setupComplete'] === 1);

        $this->accountService->setAccountActive($token->getAccount(), true);
        $this->accountService->updateLastUserLogin($account);
        $this->tokenService->setTokenIsUsedUp($token->getId());

        $_SESSION[Software::SESSION_USERID_NAME] = $account->getId();
        if (!$account->isSetupComplete()) {
            return new RedirectResponse('/authentication/setup');
        }

        return new RedirectResponse('/overview');
    }

}