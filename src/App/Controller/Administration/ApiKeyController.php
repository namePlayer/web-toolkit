<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Service\ApiKey\ApiKeyService;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiKeyController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ApiKeyService $apiKeyService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {

        return new HtmlResponse($this->template->render(
            'administration/apiKeyList',
            [
                'apiKeys' => $this->apiKeyService->getAllApiKeys()
            ]
        ));
    }

}
