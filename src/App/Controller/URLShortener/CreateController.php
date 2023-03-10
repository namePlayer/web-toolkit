<?php

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Model\UrlShortener\Shortlink;
use App\Service\UrlShortener\ShortlinkService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ShortlinkService $shortlinkService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool*/
        $tool = $request->getAttribute(Tool::class);

        if($request->getMethod() === 'POST')
        {
            $shortenedLink = $this->create($request, $account);
        }

        return new HtmlResponse(

            $this->template->render(
                'urlShortener/createPage',
                [
                    'toolInformation' => ['tool-title' => $tool->getTitle(), 'tool-description' => $tool->getDescription()],
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

            $shortenedLink = $this->shortlinkService->create($shortlink);

            if($shortenedLink !== NULL)
            {
                MESSAGES->add('success', 'link-successfully-shortened');
                return $shortenedLink;
            }

        }

        return null;
    }

}