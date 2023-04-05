<?php
declare(strict_types=1);

namespace App\Controller;

use App\Http\HtmlResponse;
use App\Model\UrlShortener\Shortlink;
use App\Service\UrlShortener\ShortlinkDomainService;
use App\Service\UrlShortener\ShortlinkService;
use App\Software;
use Laminas\Diactoros\Response;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

readonly class IndexController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkService       $shortlinkService,
        private ShortlinkDomainService $shortlinkDomainService
    )
    {
    }

    public function load(ServerRequestInterface $request): Response
    {
        $domain = '';
        if($request->getMethod() === 'POST')
        {
            $domain = $this->shortlinkCreate($request);
        }

        return new HtmlResponse(
            $this->template->render('publicPage/index', ['domain' => $domain])
        );
    }

    public function shortlinkCreate(ServerRequestInterface $request): ?string
    {

        if(isset($_POST['indexPageShortlinkCreateDestination']))
        {

            if(empty($_POST['indexPageShortlinkCreateDestination']))
            {
                MESSAGES->add('danger', 'homepage-content-create-shortlink-empty-error');
                return null;
            }

            $shortlink = new Shortlink();
            $shortlink->setDomain(1);
            $shortlink->setDestination($_POST['indexPageShortlinkCreateDestination']);
            $shortlink->setExpiryDate(null);
            $shortlink->setAccount($_SESSION[Software::SESSION_USERID_NAME] ?? null);
            $shortlink->setTracking(false);
            $shortlink->setPassword(null);

            if($this->shortlinkService->create($shortlink) !== FALSE)
            {
                return 'https://' . $this->shortlinkDomainService->getById($shortlink->getDomain())['address'] . '/' . $shortlink->getUuid();
            }

        }

        MESSAGES->add('danger', 'homepage-content-create-shortlink-unknown-error');
        return null;

    }

}
