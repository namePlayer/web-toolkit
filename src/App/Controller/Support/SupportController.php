<?php

namespace App\Controller\Support;

use App\Http\HtmlResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SupportController
{

    public function __construct(
        private Engine        $template
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'support/support'
            )
        );
    }

}
