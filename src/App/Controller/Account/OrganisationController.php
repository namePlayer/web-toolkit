<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\TokenType;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\TokenService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OrganisationController
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
            $this->manage($account);
        }

        if($account->getBusiness() !== null)
        {
            $organisation = $this->accountService->findAccountById($account->getBusiness());
        }

        return new HtmlResponse($this->template->render(
            'account/organisation/organisation',
            [
                'organisation' => $organisation ?? null,
                'account' => $account
            ]
        ));
    }

    public function manage(Account $account): void
    {
        if(isset($_POST['organisationJoinInviteCode']))
        {
            $token = $this->tokenService->getByToken($_POST['organisationJoinInviteCode']);
            if($token === FALSE || $token->getType() !== TokenType::ORGANISATION_INVITE_TOKEN) {
                MESSAGES->add('danger', 'organisation-settings-invite-not-found');
                return;
            }

            if(($token->getExpiry() !== NULL && $token->getExpiry() < new \DateTime()) || $token->isUsed())
            {
                MESSAGES->add('danger', 'organisation-settings-invite-expired');
                return;
            }

            $this->accountService->setAccountOrganisation($account->getId(), $token->getAccount());
            MESSAGES->add('success', 'organisation-settings-invite-organisation-joined');
            $account->setBusiness($token->getAccount());

        }
    }

}
