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

readonly class SupportController
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

        $currentModule = 'allTickets';
        $pages = ['myTickets', 'search'];
        if(!empty($args['module']) && in_array($args['module'], $pages)) {
            $currentModule = $args['module'];
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/support/supportList',
                [
                    'currentPage' => $currentModule,
                    'allOpenTickets' => $this->supportTicketService->countAllOpenTickets(),
                    'openTickets' => $this->supportTicketService->getAllOpenTickets($currentModule === 'myTickets' ? $account->getId() : null)
                ]
            )
        );
    }

}
