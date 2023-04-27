<?php
declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Authentication\TokenType;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\TokenService;
use DateTime;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class ResetPasswordController
{

    public function __construct(
        private TokenService   $tokenService,
        private AccountService $accountService,
        private Engine         $template
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($_GET['token'])) {
            return new RedirectResponse('/authentication/login');
        }

        $token = $this->tokenService->getByToken($_GET['token']);
        if (
            $token === false ||
            ($token->getExpiry() !== null && $token->getExpiry() < new DateTime()) ||
            $token->isUsed() ||
            $token->getType() !== TokenType::RESET_PASSWORD_TOKEN
        ) {
            return new RedirectResponse('/authentication/login');
        }

        if ($request->getMethod() === "POST") {
            $this->reset($request, $token);
        }

        return new HtmlResponse($this->template->render('authentication/resetPassword'));
    }

    public function reset(ServerRequestInterface $request, Token $token): void
    {
        if (!isset($_POST['resetPasswordPassword'], $_POST['resetPasswordPasswordAgain'])) {
            return;
        }

        $account = new Account();
        $account->setId($token->getAccount());
        $account->setPassword(trim($_POST['resetPasswordPassword']));

        if ($this->accountService->setNewPassword($account, trim($_POST['resetPasswordPasswordAgain']))) {
            $this->tokenService->setTokenIsUsedUp($token->getId());
            MESSAGES->add('success', 'reset-password-successful');
        }
    }

}
