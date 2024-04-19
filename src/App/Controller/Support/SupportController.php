<?php declare(strict_types=1);

namespace App\Controller\Support;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Support\SupportTicket;
use App\Model\Support\SupportTicketMessage;
use App\Service\Support\SupportTicketService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class SupportController
{

    public function __construct(
        private Engine $template,
        private readonly SupportTicketService $supportTicketService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if($request->getMethod() === 'POST')
        {
            $this->processSupportRequest($account->getId());
        }

        return new HtmlResponse(
            $this->template->render(
                'support/support', [
                    'ticketList' => $this->supportTicketService->getAllTicketsForUser($account->getId())
                ]
            )
        );
    }

    public function processSupportRequest(int $accountId): void
    {
        if(!empty($_POST['createTicketTitle']) && !empty($_POST['createTicketMessage']))
        {
            $supportTicket = new SupportTicket();
            $supportTicket->setAccount($accountId);
            $supportTicket->setTitle($_POST['createTicketTitle']);
            $supportTicketMessage = new SupportTicketMessage();
            $supportTicketMessage->setMessage($_POST['createTicketMessage']);
            $supportTicketMessage->setAccount($accountId);

            $create = $this->supportTicketService->createSupportTicket($supportTicket, $supportTicketMessage);
            if($create === 0)
            {
                MESSAGES->add('success', 'support-ticket-created-successfully');
                return;
            }

            MESSAGES->add('danger', 'support-ticket-creation-failed');
        }
    }

}
