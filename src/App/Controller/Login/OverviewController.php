<?php

declare(strict_types=1);

namespace App\Controller\Login;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Tool\ToolService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class OverviewController
{

    public function __construct(
        private Engine      $engine,
        private ToolService $toolService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        return new HtmlResponse(
            $this->engine->render(
                'login/overview',
                ['availableTools' => $this->toolService->getAllToolsForUser($account)]
            )
        );
    }

}
