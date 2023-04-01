<?php

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\PasswordService;
use App\Service\MailerService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LostPasswordController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService,
        private readonly MailerService $mailerService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if($request->getMethod() === "POST")
        {
            $this->resetPassword($request);
        }

        return new HtmlResponse($this->template->render('authentication/lostPassword'));
    }

    public function resetPassword(ServerRequestInterface $request)
    {

        if(!isset($_POST['resetPasswordEmail'])) {
            return;
        }

        $account = new Account();
        $account->setEmail($_POST['resetPasswordEmail']);

        $token = $this->accountService->resetPassword($account);

        if(!$token instanceof Token)
        {
            return;
        }

        if(!empty($token->getToken()))
        {
            $this->mailerService->configureMail($account->getEmail(), 'Reset Password', 'resetPassword', ['token' => $token->getToken()])->send();
        }

        MESSAGES->add('success', 'reset-password-success');

    }

}