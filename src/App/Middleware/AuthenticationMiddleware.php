<?php

namespace App\Middleware;

use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Software;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{

    public function __construct(
        private readonly AccountService $accountService
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        if(empty($_SESSION[Software::SESSION_USERID_NAME]))
        {
            return new RedirectResponse('/authentication/login');
        }

        $account = new Account();
        $account->setId($_SESSION[Software::SESSION_USERID_NAME]);

        $accountData = $this->accountService->findAccountById($account->getId());
        if($accountData === FALSE || $accountData['active'] === 0)
        {
            session_destroy();
            return new RedirectResponse('/authentication/login');
        }

        $account->setEmail($accountData['email']);
        $account->setBusiness($accountData['business']);
        $account->setAdmin($accountData['isAdmin']);

        return $handler->handle($request->withAttribute(Account::class, $account));

    }
}