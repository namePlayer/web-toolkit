<?php

declare(strict_types=1);

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use App\Service\UrlShortener\ShortlinkTrackingService;
use App\Tool\ShortlinkTool;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class LinkViewController
{

    public function __construct(
        private Engine $template,
        private ShortlinkService $shortlinkService,
        private ShortlinkTrackingService $shortlinkTrackingService,
        private ShortlinkDomainService $shortlinkDomainService
    ) {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool */
        $tool = $request->getAttribute(Tool::class);

        if (empty($args['linkId'])) {
            return new RedirectResponse('/');
        }

        $link = $this->shortlinkService->getShortlinkById((int)$args['linkId']);

        if ($link->getAccount() !== $account->getId()) {
            return new RedirectResponse(ShortlinkTool::TOOL_URL . '/list');
        }

        return new HtmlResponse(
            $this->template->render(
                'urlShortener/linkView',
                [
                    'tool' => $tool,
                    'shortlink' => $link,
                    'trackingData' => $link->isTracking() ? $this->shortlinkTrackingService->getLastClicksForLink(
                        $link->getId(),
                        10
                    ) : [],
                    'shortlinkDomain' => $link->getDomain() === null ? ShortlinkTool::getDefaultUrl(
                    ) : $this->shortlinkDomainService->getById($link->getDomain())['address'],
                    'browserList' => $this->shortlinkTrackingService->getLinkBrowserAmount($link->getId(), 10),
                    'countryList' => $this->shortlinkTrackingService->getLinkCountryAmount($link->getId(), 10)
                ]
            )
        );
    }

}
