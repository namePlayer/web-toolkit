<?php

namespace App\Controller\Login;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\AccountLevel;
use App\Service\Tool\ToolService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OverviewController
{

    public function __construct(
        private readonly Engine $engine,
        private readonly ToolService $toolService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {

        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        return new HtmlResponse(
            $this->engine->render('login/overview',
                ['availableTools' => $this->toolService->getAllToolsForUser($account)]
            )
        );
    }

}