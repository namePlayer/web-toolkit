<?php
declare(strict_types=1);

namespace App\Controller\Support;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Support\SupportTicketMessage;
use App\Service\Support\SupportTicketService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SupportTicketManageController
{

    public function __construct(
        private readonly Engine $template,
        private readonly SupportTicketService $supportTicketService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        $ticketData = $this->supportTicketService->getTicketById((int)$args['id'] ?? 0);
        if($ticketData === NULL || $ticketData['account'] !== $account->getId()) {
            return new RedirectResponse('/support');
        }

        if($request->getMethod() === 'POST')
        {
            $this->process($account->getId(), $ticketData);
        }

        return new HtmlResponse($this->template->render('support/supportTicket', [
            'ticketData' => $ticketData,
            'ticketMessages' => $this->supportTicketService->getAllTicketMessagesByTicketId($ticketData['id']),
        ]));
    }

    public function process(int $userId, array &$ticketData): void
    {
        if(isset($_POST['ticketUserChangeStatus']))
        {
            if($ticketData['status'] === 0)
            {
                if($this->supportTicketService->updateTicketStatus($ticketData['id'], 1))
                {
                    MESSAGES->add('success', 'support-ticket-status-change-close-successful');
                    $ticketData['status'] = 1;
                    return;
                }
            }

            if($ticketData['status'] === 1)
            {
                if($this->supportTicketService->updateTicketStatus($ticketData['id'], 0))
                {
                    MESSAGES->add('success', 'support-ticket-status-change-open-successful');
                    $ticketData['status'] = 0;
                    return;
                }
            }

        }

        if(!empty($_POST['addTicketResponseModalLabelMessage']))
        {
            $supportTicketResponse = new SupportTicketMessage();
            $supportTicketResponse->setAccount($userId);
            $supportTicketResponse->setTicket((int)$ticketData['id']);
            $supportTicketResponse->setMessage($_POST['addTicketResponseModalLabelMessage']);
            $supportTicketResponse->setCreated(new \DateTime());

            if($this->supportTicketService->createTicketMessageReply($supportTicketResponse))
            {
                MESSAGES->add('success', 'support-ticket-reply-successful');
                return;
            }

            MESSAGES->add('danger', 'support-ticket-reply-failed');
        }
    }

}
