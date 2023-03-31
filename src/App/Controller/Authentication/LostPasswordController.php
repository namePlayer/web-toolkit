<?php

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\PasswordService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LostPasswordController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService,
        private readonly PasswordService $passwordService
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

        if($this->accountService->resetPassword($account) === FALSE)
        {
            return;
        }

        MESSAGES->add('success', 'reset-password-success');

    }

}