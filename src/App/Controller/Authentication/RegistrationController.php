<?php

declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\AccountLevel;
use App\Model\Authentication\Token;
use App\Model\Authentication\TokenType;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\TokenService;
use App\Service\MailerService;
use DateInterval;
use DateTime;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class RegistrationController
{

    public function __construct(
        private Engine $template,
        private AccountService $accountService,
        private TokenService $tokenService,
        private MailerService $mailerService
    ) {
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

            $token = new Token();
            $token->setAccount($account->getId());
            $token->setType(TokenType::ACTIVATION_TOKEN);
            $token->setExpiry((new DateTime())->add(new DateInterval('PT1H')));

            $this->tokenService->create($token);
            $this->mailerService->configureMail(
                $account->getEmail(),
                'Account aktivieren',
                'activateAccount',
                ['token' => $token->getToken(), 'name' => $account->getName()]
            )->send();
        }
    }

}
