<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\DTO\UrlShortener\ShortlinkSearchDTO;
use App\Http\HtmlResponse;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AllDomainsController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkDomainService $shortlinkDomainService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/allDomains',
                [
                    'domainList' => $this->shortlinkDomainService->getAllDomains()
                ]
            )
        );
    }

}
