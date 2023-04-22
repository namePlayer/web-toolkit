<?php declare(strict_types=1);

namespace App\Middleware;

use App\Model\Authentication\Account;
use App\Service\Account\SecurityService;
use App\Software;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class TwoFactorMiddleware implements MiddlewareInterface
{

    public function __construct(
        private SecurityService $securityService
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if(!$this->securityService->accountHasTwoFactorEnabled($account->getId()))
        {
            return $handler->handle($request);
        }

        if(empty($_SESSION[Software::SESSION_TFA_NAME]))
        {
            return new RedirectResponse('/authentication/twoFactor?redirect=' . $request->getUri());
        }

        return $handler->handle($request);
    }
}
