<?php

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AccountListController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/accountList',
                ['accounts' => $this->accountService->getAccountList()]
            )
        );
    }

}