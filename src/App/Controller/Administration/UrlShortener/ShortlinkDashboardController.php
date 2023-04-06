<?php declare(strict_types=1);

namespace App\Controller\Administration\UrlShortener;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ShortlinkDashboardController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ShortlinkService $shortlinkService,
        private readonly ShortlinkDomainService $shortlinkDomainService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/urlShortener/shortlinkDashboard',
                [
                    'shortlinkAmount' => $this->shortlinkService->getShortlinkCount(),
                    'shortlinkAmountLastSevenDays' => $this->shortlinkService->getShortlinkCountForLastDays(7),
                    'shortlinkDomainAmount' => $this->shortlinkDomainService->getCount(),
                    'lastShortlinkList' => $this->shortlinkService->getAllShortlinksByLimit(10),
                    'lastDomainList' => $this->shortlinkDomainService->getAllByLimitDescending(10),
                    'defaultShortlinkDomain' => $this->shortlinkService->defaultShortlinkDomain()
                ]
            )
        );
    }

}
