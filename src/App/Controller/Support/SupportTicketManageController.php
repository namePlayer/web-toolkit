<?php

namespace App\Controller\Support;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
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

        $ticketData = $this->supportTicketService->getTicketById($args['id'] ?? 0);
        if($ticketData === NULL || $ticketData['account'] !== $account->getId()) {
            return new RedirectResponse('/support');
        }

        return new HtmlResponse($this->template->render('support/supportTicket', [
            'ticketData' => $ticketData,
            'ticketMessages' => $this->supportTicketService->getAllTicketMessagesByTicketId($ticketData['id']),
        ]));
    }

}