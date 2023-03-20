<?php
declare(strict_types=1);

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Model\UrlShortener\Shortlink;
use App\Service\UrlShortener\ShortlinkPasswordService;
use App\Service\UrlShortener\ShortlinkService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ShortlinkService $shortlinkService,
        private readonly ShortlinkPasswordService $passwordService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        /* @var $tool Tool*/
        $account = $request->getAttribute(Account::class);
        $tool = $request->getAttribute(Tool::class);

        if($request->getMethod() === 'POST')
        {
            $shortenedLink = $this->create($request, $account);
        }

        return new HtmlResponse(

            $this->template->render(
                'urlShortener/createPage',
                [
                    'toolInformation' => ['tool-title' => $tool->getTitle(), 'tool-description' => $tool->getDescription(), 'tool-path' => $tool->getPath()],
                    'shortenedLink' => $shortenedLink ?? null
                ]
            )
        );
    }

    public function create(ServerRequestInterface $request, Account $account): ?string
    {
        if(isset($_POST['urlShortenerLink']))
        {

            $shortlink = new Shortlink();
            $shortlink->setDestination($_POST['urlShortenerLink']);
            $shortlink->setAccount($account->getId());
            $shortlink->setTracking(isset($_POST['urlShortenerEnableTracking']));

            if(!empty($_POST['urlShortenerCustomShortcode']))
            {
                $shortlink->setUuid($_POST['urlShortenerCustomShortcode']);
            }

            if(!empty($_POST['urlShortenerExpiryDate']))
            {
                $shortlink->setExpiryDate(new \DateTime($_POST['urlShortenerExpiryDate']));
            }

            if(!empty($_POST['urlShortenerPassword']))
            {
                $shortlink->setPassword($this->passwordService->generatePassword($_POST['urlShortenerPassword']));
            }

            $shortenedLink = $this->shortlinkService->create($shortlink);

            if($shortenedLink !== NULL)
            {
                MESSAGES->add('success', 'link-successfully-shortened', '<a href="'.$shortenedLink.'">'.$shortenedLink.'</a>');
                return $shortenedLink;
            }

        }

        return null;
    }

}
