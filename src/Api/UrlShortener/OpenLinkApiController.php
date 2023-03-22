<?php

namespace Api\UrlShortener;

use App\Http\JsonResponse;
use App\Service\ApiKey\ApiKeyService;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OpenLinkApiController
{

    public function __construct(
        private readonly ApiKeyService $apiKeyService,
        private readonly ShortlinkDomainService $shortlinkDomainService,
        private readonly ShortlinkService $shortlinkService
    )
    {
    }

    public function access(ServerRequestInterface $request): ResponseInterface
    {

        return new JsonResponse(200, [], 'success');

    }

}