<?php

declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\AccountLevel;
use App\Model\Mail\MailType;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\TokenService;
use App\Service\MailerService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class RegistrationController
{

    public function __construct(
        private Engine         $template,
        private AccountService $accountService,
        private TokenService   $tokenService,
        private MailerService  $mailerService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === 'POST') {
            $this->register($request);
        }

        return new HtmlResponse($this->template->render('authentication/registration'));
    }

    private function register(ServerRequestInterface $request): void
    {
        if(($_ENV['SOFTWARE_ENABLE_REGISTRATION'] ?? true) === false)
        {
            return;
        }

        if (isset($_POST['account-type'], $_POST['account-name'], $_POST['email'], $_POST['password'])) {
            $account = new Account();
            $account->setName(trim($_POST['account-name']));
            $account->setEmail(trim($_POST['email']));
            $account->setPassword(trim($_POST['password']));
            $account->setLevel(AccountLevel::BASIC_LEVEL);
            if ($_POST['account-type'] !== 'private' && $_POST['account-type'] !== 'business') {
                return;
            }
            $account->setBusiness($_POST['account-type'] === 'business' ? 0 : null);

            if ($this->accountService->create($account) === false) {
                return;
            }

            $token = $this->accountService->generateActivationToken($account);

            $this->mailerService->configureMail(
                $account->getEmail(),
                'Account aktivieren',
                MailType::ACTIVATION_MAIL_ID,
                ['token' => $token->getToken(), 'name' => $account->getName()]
            )->send();
        }
    }

}
