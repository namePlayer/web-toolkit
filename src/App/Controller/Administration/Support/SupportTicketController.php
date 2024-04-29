<?php

declare(strict_types=1);

namespace App\Controller\Administration\Support;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Support\SupportTicket;
use App\Model\Support\SupportTicketMessage;
use App\Service\Authentication\AccountService;
use App\Service\Support\SupportTicketService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class SupportTicketController
{

    public function __construct(
        private Engine $template,
        private SupportTicketService $supportTicketService,
        private AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if(empty($args['id']))
        {
            return new RedirectResponse('/admin/support');
        }

        $ticketData = $this->supportTicketService->getTicketById((int)$args['id']);
        if($ticketData === null)
        {
            return new RedirectResponse('/admin/support');
        }

        if($request->getMethod() === 'POST')
        {
            $this->process($ticketData, $account->getId());
            $ticketData = $this->supportTicketService->getTicketById((int)$args['id']);
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/support/supportTicket',
                [
                    'allOpenTickets' => $this->supportTicketService->countAllOpenTickets(),
                    'ticketData' => $ticketData,
                    'ticketMessages' => $this->supportTicketService->getAllTicketMessagesByTicketId((int)$args['id']),
                    'supportPermissionUserList' => $this->accountService->getAccountListWithSupportPermissions(),
                    'customerInformation' => $this->accountService->findAccountById($ticketData['account'])
                ]
            )
        );
    }

    public function process(array $ticket, int $account): void
    {

        if(!empty($_POST['addNewTechResponseModalText']))
        {
            $supportTicketMessage = new SupportTicketMessage();
            $supportTicketMessage->setTicket($ticket['id']);
            $supportTicketMessage->setAccount($account);
            $supportTicketMessage->setCreated(new \DateTime());
            $supportTicketMessage->setMessage($_POST['addNewTechResponseModalText']);

            if($this->supportTicketService->createTicketMessageReply($supportTicketMessage))
            {
                $this->supportTicketService->updateTicketWaitingForCustomerResponse($ticket['id'], true);#
                $this->supportTicketService->setLastUpdatedTime($ticket['id'], new \DateTime());
                MESSAGES->add('success', 'admin-support-reply-successful');
                return;
            }

            MESSAGES->add('success', 'admin-support-reply-failed');
            return;
        }

        if(isset($_POST['ticketSettingsSave']))
        {

            $newStatus = 1;
            if(!empty($_POST['ticketSettingStatus']))
            {
                $newStatus = (int)$_POST['ticketSettingStatus'];
            }

            $newTech = null;
            if(!empty($_POST['ticketSettingAssignedTech']))
            {
                $newTech = (int)$_POST['ticketSettingAssignedTech'];
            }

            $supportTicket = new SupportTicket();
            $supportTicket->setId($ticket['id']);
            $supportTicket->setAccount($ticket['id']);
            $supportTicket->setStatus($newStatus);
            $supportTicket->setAssignedTechAccount($newTech);
            $supportTicket->setOnHold((int)$_POST['ticketSettingOnHold'] === 1);

            if($this->supportTicketService->updateTicketDetails($supportTicket))
            {
                $this->supportTicketService->setLastUpdatedTime($ticket['id'], new \DateTime());
                MESSAGES->add('success', 'admin-support-ticket-update-successful');
                return;
            }

            MESSAGES->add('danger', 'admin-support-ticket-update-failed');
            return;
        }

    }

}
