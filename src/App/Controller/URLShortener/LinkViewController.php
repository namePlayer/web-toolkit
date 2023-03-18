<?php

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Service\UrlShortener\ShortlinkService;
use App\Service\UrlShortener\ShortlinkTrackingService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LinkViewController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ShortlinkService $shortlinkService,
        private readonly ShortlinkTrackingService $shortlinkTrackingService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool*/
        $tool = $request->getAttribute(Tool::class);

        if(empty($args['linkId']))
        {
            return new RedirectResponse('/');
        }

        $link = $this->shortlinkService->getShortlinkById($args['linkId']);

        return new HtmlResponse(
            $this->template->render(
                'urlShortener/linkView',
                [
                    'toolInformation' => ['tool-title' => $tool->getTitle(), 'tool-description' => $tool->getDescription(), 'tool-path' => $tool->getPath()],
                    'shortlink' => $link,
                    'trackingData' => $link->isTracking() ? $this->shortlinkTrackingService->getLastClicksForLink($link->getId(), '10') : []
                ]
            )
        );
    }

}