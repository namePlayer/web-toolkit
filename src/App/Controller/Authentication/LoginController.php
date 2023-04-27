<?php

declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Mail\MailType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\Authentication\PasswordService;
use App\Service\MailerService;
use App\Service\Security\AccountTrustedDeviceService;
use App\Service\UserInformationService;
use App\Software;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class LoginController
{

    public function __construct(
        private Engine                      $template,
        private AccountService              $accountService,
        private PasswordService             $passwordService,
        private MailerService               $mailerService,
        private SecurityService             $securityService,
        private AccountTrustedDeviceService $accountTrustedDeviceService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === "POST") {
            $login = $this->login($request);
            if ($login instanceof ResponseInterface) {
                return $login;
            }
        }

        return new HtmlResponse($this->template->render('authentication/login'));
    }

    public function login(ServerRequestInterface $request): ?ResponseInterface
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $account = new Account();
            $account->setEmail(trim($_POST['email']));
            $account->setPassword(trim($_POST['password']));

            $login = $this->accountService->findAccountByEmail($account->getEmail());
            if ($login === false) {
                MESSAGES->add('danger', 'login-wrong-combination');
                return null;
            }

            $account->setName($login['name']);
            $account->setId($login['id']);
            $account->setActive((int)$login['active'] === 1);
            $account->setSetupComplete((int)$login['setupComplete'] === 1);
            $account->setSendMailUnknownLogin((int)$login['sendMailUnknownLogin'] === 1);

            if ($account->isActive() === false) {
                MESSAGES->add('danger', 'login-account-disabled');
                return null;
            }

            if ($this->passwordService->verifyPassword($account->getPassword(), $login['password'])) {
                $userInformation = new UserInformationService();

                MESSAGES->add('success', 'login-account-successful');
                $this->accountService->updateLastUserLogin($account);

                if ($account->isSendMailUnknownLogin() && !$this->accountTrustedDeviceService->accountHasTrustedIp($account->getId(), $_SERVER['REMOTE_ADDR'])) {
                    $this->mailerService->configureMail(
                        $account->getEmail(),
                        'Neue Anmeldung erkannt',
                        MailType::NEW_LOGIN_DETECTED_MAIL_ID,
                        [
                            'accountName' => $account->getName(),
                            'browser' => $userInformation->configure($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'])->getBrowser(),
                            'country' => $userInformation->getCountry(),
                            'ip' => $userInformation->getIP()
                        ],
                        $account->getId()
                    )->send();
                }


                $_SESSION[Software::SESSION_USERID_NAME] = $account->getId();
                if (!empty($this->securityService->getTwoFactorByAccountID($account->getId()))) {
                    if (!empty($_GET['redirect'])) {
                        return new RedirectResponse("/authentication/twoFactor?redirect=" . $_GET['redirect']);
                    }
                    return new RedirectResponse('/authentication/twoFactor');
                }

                if (!$account->isSetupComplete()) {
                    return new RedirectResponse("/authentication/setup");
                }

                if (!empty($_GET['redirect'])) {
                    return new RedirectResponse($_GET['redirect']);
                }

                return new RedirectResponse("/overview");
            }

            MESSAGES->add('danger', 'login-wrong-combination');
        }

        return null;
    }

}
