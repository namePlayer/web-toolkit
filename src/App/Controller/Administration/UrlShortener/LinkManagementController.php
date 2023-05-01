<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\Http\HtmlResponse;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LinkManagementController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkService       $shortlinkService,
        private ShortlinkDomainService $shortlinkDomainService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        if(empty((int)$args['id']))
        {
            return new RedirectResponse('/admin/urlshortener/alllinks');
        }

        $linkInformation = $this->shortlinkService->getShortlinkById((int)$args['id']);
        if($linkInformation === FALSE)
        {
            return new RedirectResponse('/admin/urlshortener/alllinks');
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/linkManagement',
                [
                    'data' => $linkInformation,
                    'domain' => $linkInformation->getDomain() === null ? null : $this->shortlinkDomainService->getDomainNameByID($linkInformation->getDomain())
                ]
            )
        );
    }

}
