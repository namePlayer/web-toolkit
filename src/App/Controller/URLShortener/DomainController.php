<?php

namespace App\Controller\URLShortener;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DomainController
{

    public function __construct(
        private readonly Engine $template
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool*/
        $tool = $request->getAttribute(Tool::class);

        return new HtmlResponse(
            $this->template->render(
                'urlShortener/domainOverview',
                [
                    'toolInformation' => ['tool-title' => $tool->getTitle(), 'tool-description' => $tool->getDescription(), 'tool-path' => $tool->getPath()]
                ]
            )
        );
    }

}