<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Authentication\TokenType;
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
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if($request->getMethod() === "POST")
        {
            $token = $this->create($account->getId());
        }

        return new HtmlResponse(
            $this->template->render('account/organisation/organisationInvite', [
                'inviteList' => $this->tokenService->getTokensByTypeAndAccount(
                    TokenType::ORGANISATION_INVITE_TOKEN, $account->getId())
            ]));
    }

    public function create(int $account): ?string
    {
        $token = new Token();
        $token->setType(TokenType::ORGANISATION_INVITE_TOKEN);
        $token->setAccount($account);
        $token->setExpiry(null);
        if(!empty($_POST['organisationInviteExpiryDate']))
        {
            $token->setExpiry(new \DateTime($_POST['organisationInviteExpiryDate']));
        }

        if($this->tokenService->create($token) !== FALSE)
        {
            return $token->getToken();
        }

        return null;
    }

}
