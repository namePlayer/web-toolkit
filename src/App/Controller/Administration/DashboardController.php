<?php

declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class DashboardController
{

    public function __construct(
        private Engine $template,
        private AccountService $accountService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/dashboard',
                ['accountCount' => $this->accountService->getAllAccountsCount()]
            )
        );
    }

}
