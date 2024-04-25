<?php

declare(strict_types=1);

namespace App\Controller\Administration\Support;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Support\SupportTicketService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class SupportTicketController
{

    public function __construct(
        private Engine $template,
        private SupportTicketService $supportTicketService
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
        if($ticketData === false)
        {
            return new RedirectResponse('/admin/support');
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/support/supportTicket',
                [
                    'allOpenTickets' => $this->supportTicketService->countAllOpenTickets(),
                    'ticketData' => $ticketData,
                    'ticketMessages' => $this->supportTicketService->getAllTicketMessagesByTicketId((int)$args['id'])
                ]
            )
        );
    }

}
