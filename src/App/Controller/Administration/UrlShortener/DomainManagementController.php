<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\DTO\UrlShortener\ShortlinkDeleteDTO;
use App\Http\HtmlResponse;
use App\Service\Security\SecurityKeyService;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use App\Service\UrlShortener\ShortlinkTrackingService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DomainManagementController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkDomainService $shortlinkDomainService,
        private SecurityKeyService     $securityKeyService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        if(empty((int)$args['id']))
        {
            return new RedirectResponse('/admin/urlshortener/alldomains');
        }

        $domainInformation = $this->shortlinkDomainService->getById((int)$args['id']);
        if(empty($domainInformation))
        {
            return new RedirectResponse('/admin/urlshortener/alldomains');
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/domainManagement',
                [
                    'data' => $domainInformation
                ]
            )
        );
    }

}
