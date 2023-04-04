<?php
declare(strict_types=1);

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Model\UrlShortener\Shortlink;
use App\Service\UrlShortener\ShortlinkDomainService;
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
        private readonly ShortlinkPasswordService $passwordService,
        private readonly ShortlinkDomainService $shortlinkDomainService
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
                    'domains' => $this->shortlinkDomainService->getDomainListForUser($account->getId()),
                    'shortenedLink' => $shortenedLink ?? null
                ]
            )
        );
    }

    public function create(ServerRequestInterface $request, Account $account): ?array
    {
        if(isset($_POST['urlShortenerLink']))
        {

            $shortlink = new Shortlink();
            $shortlink->setDestination($_POST['urlShortenerLink']);
            $shortlink->setAccount($account->getId());
            $shortlink->setTracking(isset($_POST['urlShortenerEnableTracking']));

            if(!empty($_POST['urlShortenerLinkAddress']))
            {
                $domain = $this->shortlinkDomainService->getByUUID($_POST['urlShortenerLinkAddress']);
                if($domain !== [] && $this->shortlinkDomainService->accountIsAllowedToUseDomain($account->getId(), $domain['id']))
                {
                    $shortlink->setDomain($domain['id']);
                }
            }

            $shortlinkUUID = trim($_POST['urlShortenerCustomShortcode']);
            if(!empty($shortlinkUUID))
            {
                $shortlink->setUuid($shortlinkUUID);
            }

            if(!empty($_POST['urlShortenerExpiryDate']))
            {
                $shortlink->setExpiryDate(new \DateTime($_POST['urlShortenerExpiryDate']));
            }

            if(!empty($_POST['urlShortenerPassword']))
            {
                $shortlink->setPassword($this->passwordService->generatePassword($_POST['urlShortenerPassword']));
            }

            $shortenLinkResult = $this->shortlinkService->create($shortlink);

            if($shortenLinkResult !== NULL)
            {
                $shortenedLink =
                    [
                        'domain' => 'http://' . $_SERVER['SERVER_NAME'] . '/aka',
                        'code' => $shortlink->getUuid()
                    ];
                if($shortlink->getDomain() !== NULL)
                {
                    $shortenedLink['domain'] =
                        'http://' . $this->shortlinkDomainService->getById($shortlink->getDomain())['address'];
                }

                MESSAGES->add(
                    'success',
                    'link-successfully-shortened',
                    '<a href="'.$shortenedLink['domain'].'/'.$shortenedLink['code'].'">'.$shortenedLink['domain'].'/'.$shortenedLink['code'].'</a>');
                return $shortenedLink;
            }

        }

        return null;
    }

}
