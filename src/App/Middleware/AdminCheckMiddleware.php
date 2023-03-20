<?php

namespace App\Middleware;

use App\Model\Authentication\Account;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminCheckMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if(!$account->isAdmin())
        {
            return new RedirectResponse('/overview');
        }

        return $handler->handle($request);
    }

}