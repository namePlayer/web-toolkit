<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\TokenService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class OrganisationInviteController
{

    public function __construct(
        private Engine $template,
        private AccountService $accountService,
        private TokenService $tokenService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {

        return new HtmlResponse($this->template->render('account/organisation/organisationInvite'));
    }

}
