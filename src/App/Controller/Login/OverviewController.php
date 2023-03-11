<?php

namespace App\Controller\Login;

use App\Http\HtmlResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OverviewController
{

    public function __construct(
        private readonly Engine $engine
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->engine->render('login/overview')
        );
    }

}