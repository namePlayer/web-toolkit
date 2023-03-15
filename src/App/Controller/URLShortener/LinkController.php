<?php

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\UrlShortener\Shortlink;
use App\Service\UrlShortener\ShortlinkService;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LinkController
{

    public function __construct(
        private readonly ShortlinkService $shortlinkService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {

        if(empty($args['shortcode']))
        {
            return new RedirectResponse('/');
        }

        $shortlink = new Shortlink();
        $shortlink->setDomain(null);
        $shortlink->setUuid($args['shortcode']);

        $this->shortlinkService->openShortlink($shortlink);

        if(empty($shortlink->getDestination()))
        {
            return new RedirectResponse('/');
        }

        if($shortlink->getExpiryDate() !== NULL && $shortlink->getExpiryDate() < new \DateTime())
        {
            return new HtmlResponse('<p>Link has already expired.</p>');
        }

        return new RedirectResponse($shortlink->getDestination());

    }

}