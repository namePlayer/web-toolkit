<?php

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('authentication/login'));
    }

}