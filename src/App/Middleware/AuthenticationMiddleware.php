<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Software;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class
AuthenticationMiddleware implements MiddlewareInterface
{

    public function __construct(
        private AccountService $accountService
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (
            empty($_SESSION[Software::SESSION_USERID_NAME]) &&
            $request->getMethod() === "GET"
        ) {
            return new RedirectResponse('/authentication/login?redirect=' . $request->getUri());
        }

        $account = new Account();
        $account->setId($_SESSION[Software::SESSION_USERID_NAME]);

        $accountData = $this->accountService->findAccountById($account->getId());
        if ($accountData === false || $accountData['active'] === 0) {
            session_destroy();
            return new RedirectResponse('/authentication/login');
        }

        $account->setName($accountData['name']);
        $account->setEmail($accountData['email']);
        $account->setBusiness($accountData['business']);
        $account->setAdmin($accountData['isAdmin'] === 1);
        $account->setLevel($accountData['level']);
        $account->setSendMailUnknownLogin($accountData['sendMailUnknownLogin'] === 1);

        return $handler->handle($request->withAttribute(Account::class, $account));
    }
}
