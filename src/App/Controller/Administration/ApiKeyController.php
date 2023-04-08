<?php
declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Model\ApiKey\ApiKey;
use App\Service\ApiKey\ApiKeyService;
use DateTime;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class ApiKeyController
{

    public function __construct(
        private Engine $template,
        private ApiKeyService $apiKeyService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === 'POST') {
            $create = $this->create($request);
            if ($create instanceof RedirectResponse) {
                return $create;
            }
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/apiKeyList',
                [
                    'apiKeys' => $this->apiKeyService->getAllApiKeys()
                ]
            )
        );
    }

    public function create(ServerRequestInterface $request)
    {
        if (isset($_POST['adminApiKeyCreateNewModalUserId'], $_POST['adminApiKeyCreateNewModalExpiryDate'])) {
            $apiKey = new ApiKey();
            $apiKey->setAccount(
                empty($_POST['adminApiKeyCreateNewModalUserId']) ? null : (int)$_POST['adminApiKeyCreateNewModalUserId']
            );
            if (!empty($_POST['adminApiKeyCreateNewModalExpiryDate'])) {
                $apiKey->setExpires(new DateTime($_POST['adminApiKeyCreateNewModalExpiryDate']));
            }
            $apiKey->setActive(isset($_POST['adminApiKeyCreateNewModalActivate']));

            if ($this->apiKeyService->create($apiKey) !== null) {
                return new RedirectResponse('/admin/apikey/' . $apiKey->getId());
            }
        }
    }

}
