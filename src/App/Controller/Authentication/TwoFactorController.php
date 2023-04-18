<?php

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Mail\MailType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class TwoFactorController
{

    public function __construct(
        private Engine $template,
        private SecurityService $securityService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === "POST") {
            $this->authenticate();
        }

        return new HtmlResponse($this->template->render('authentication/twoFactor'));
    }

    public function authenticate()
    {

        if(isset($_POST['totpCodeLoginTFA']))
        {



        }

    }

}