<?php

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\UrlShortener\Shortlink;
use App\Service\UrlShortener\ShortlinkPasswordService;
use App\Service\UrlShortener\ShortlinkService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LinkController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ShortlinkService $shortlinkService,
        private readonly ShortlinkPasswordService $passwordService
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
            return new HtmlResponse($this->template->render('urlShortener/linkInformation'));
        }

        if($shortlink->getPassword() !== NULL)
        {
            if(!$this->passwordCheck($request, $shortlink))
            {
                return new HtmlResponse(
                    $this->template->render(
                        'urlShortener/linkInformation'
                    ));
            }
        }

        if($shortlink->getExpiryDate() !== NULL && $shortlink->getExpiryDate() < new \DateTime())
        {
            MESSAGES->add('danger', 'url-shortener-link-already-expired');
            return new HtmlResponse($this->template->render('urlShortener/linkInformation'));
        }

        return new RedirectResponse($shortlink->getDestination());

    }

    private function passwordCheck(ServerRequestInterface $request, Shortlink $shortlink): bool
    {

        if(!empty($_POST['urlShortenerLinkPassword']) && !empty($shortlink->getPassword())) {

            if($this->passwordService->verifyPassword($_POST['urlShortenerLinkPassword'], $shortlink->getPassword())) {
                return true;
            }

            MESSAGES->add('danger', 'url-shortener-link-password-is-invalid');
            return false;

        }

        MESSAGES->add('danger', 'url-shortener-link-password-required');
        return false;

    }

}