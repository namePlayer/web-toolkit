<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\ApiKey\ApiKeyService;
use App\Service\Authentication\AccountService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiKeyDetailController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ApiKeyService $apiKeyService,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $apiKey = $this->apiKeyService->getApiKeyById((int)$args['id']);
        $owner = new Account();
        if($apiKey === FALSE)
        {
            return new RedirectResponse('/admin/apikeys');
        }
        $owner->setName('System');
        if($apiKey->getAccount() !== NULL)
        {
            $owner->setName($this->accountService->findAccountById($apiKey->getAccount())['name']);
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/apiKeyDetail',
                [
                    'apiKey' => $apiKey,
                    'account' => $owner
                ]
            )
        );
    }

}
