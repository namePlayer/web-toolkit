<?php
declare(strict_types=1);

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Service\UrlShortener\ShortlinkDomainService;
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
        private readonly ShortlinkTrackingService $shortlinkTrackingService,
        private readonly ShortlinkDomainService $shortlinkDomainService
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

        $link = $this->shortlinkService->getShortlinkById((int)$args['linkId']);

        return new HtmlResponse(
            $this->template->render(
                'urlShortener/linkView',
                [
                    'toolInformation' => ['tool-title' => $tool->getTitle(), 'tool-description' => $tool->getDescription(), 'tool-path' => $tool->getPath()],
                    'shortlink' => $link,
                    'trackingData' => $link->isTracking() ? $this->shortlinkTrackingService->getLastClicksForLink((int)$link->getId(), 10) : [],
                    'shortlinkDomain' => $link->getDomain() === NULL ? $_SERVER['HTTP_HOST'] . '/aka' : $this->shortlinkDomainService->getById($link->getDomain())['address']
                ]
            )
        );
    }

}
