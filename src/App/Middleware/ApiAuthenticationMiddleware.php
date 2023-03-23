<?php

namespace App\Middleware;

use App\Http\JsonResponse;
use App\Model\ApiKey\ApiKey;
use App\Service\ApiKey\ApiKeyService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ApiAuthenticationMiddleware implements MiddlewareInterface
{

    public function __construct(
        private readonly ApiKeyService $apiKeyService
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';

        $keyInformation = $this->apiKeyService->getApiKeyByPassword($apiKey);
        if($keyInformation === [])
        {
            return new JsonResponse('403', [], 'invalid-apikey');
        }

        $key = new ApiKey();
        $key->setId($keyInformation['id']);
        $key->setPassword($apiKey);
        $key->setAccount($keyInformation['account']);
        $key->setActive($keyInformation['active'] === 1);
        $key->setCreated(new \DateTime($keyInformation['created']));
        if($keyInformation['expires'] !== NULL)
        {
            $key->setExpires(new \DateTime($keyInformation['expires']));
        }

        if($key->getExpires() !== NULL && $key->getExpires() <= new \DateTime())
        {
            return new JsonResponse('401', [], 'apikey-expired');
        }

        if($key->isActive() === FALSE)
        {
            return new JsonResponse('401', [], 'apikey-disabled');
        }

        return $handler->handle($request->withAttribute(ApiKey::class, $key));
    }

}