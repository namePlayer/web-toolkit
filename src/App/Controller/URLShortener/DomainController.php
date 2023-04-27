<?php

declare(strict_types=1);

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Model\UrlShortener\ShortlinkDomain;
use App\Service\UrlShortener\ShortlinkDomainService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class DomainController
{

    public function __construct(
        private Engine                 $template,
        private ShortlinkDomainService $shortlinkDomainService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool */
        $tool = $request->getAttribute(Tool::class);

        if ($request->getMethod() === "POST") {
            $this->create($request, $account);
        }

        return new HtmlResponse(
            $this->template->render(
                'urlShortener/domainOverview',
                [
                    'tool' => $tool,
                    'domainList' => $this->shortlinkDomainService->getDomainListForUser($account->getId())
                ]
            )
        );
    }

    public function create(ServerRequestInterface $request, Account $account): void
    {
        if (!empty($_POST['urlShortenerAddNewDomainName']) && !empty($_POST['urlShortenerAddNewDomainLabelRadio'])) {
            if (
                $_POST['urlShortenerAddNewDomainLabelRadio'] !== 'global' &&
                $_POST['urlShortenerAddNewDomainLabelRadio'] !== 'private'
            ) {
                return;
            }

            $shortlinkDomain = new ShortlinkDomain();
            $shortlinkDomain->setUser($account->getId());
            $shortlinkDomain->setAddress($_POST['urlShortenerAddNewDomainName']);
            $shortlinkDomain->setPublic($_POST['urlShortenerAddNewDomainLabelRadio'] === 'global');

            $this->shortlinkDomainService->create($shortlinkDomain);
        }
    }

}
