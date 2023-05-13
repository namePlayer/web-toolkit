<?php
declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Mail\MailType;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use App\Table\Authentication\AccountLevelTable;
use DateTime;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AccountViewController
{

    public function __construct(
        private Engine            $template,
        private AccountService    $accountService,
        private AccountLevelTable $accountLevelTable,
        private MailerService     $mailerService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        if (empty($args['id'])) {
            return new RedirectResponse('/admin/accounts');
        }

        $viewAccount = new Account();
        $viewAccount->setId((int)$args['id']);
        $viewAccountData = $this->accountService->findAccountById($viewAccount->getId());
        if ($viewAccountData === false) {
            return new RedirectResponse('/admin/accounts');
        }

        $viewAccount->setName($viewAccountData['name']);
        $viewAccount->setFirstname($viewAccountData['firstname']);
        $viewAccount->setSurname($viewAccountData['surname']);
        $viewAccount->setEmail($viewAccountData['email']);
        $viewAccount->setRegistered(new DateTime($viewAccountData['registered']));
        $viewAccount->setActive($viewAccountData['active'] === 1);
        $viewAccount->setLastLogin(
            $viewAccountData['lastLogin'] !== null ? new DateTime($viewAccountData['lastLogin']) : null
        );
        $viewAccount->setBusiness($viewAccountData['business']);
        $viewAccount->setLevel($viewAccountData['level']);
        $viewAccount->setSupport($viewAccountData['isSupport'] === 1);
        $viewAccount->setAdmin($viewAccountData['isAdmin'] === 1);

        if ($request->getMethod() === 'POST') {
            $this->manage($request, $viewAccount);
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/accountView', [
                    'account' => $viewAccount,
                    'levels' => $this->accountLevelTable->findAll(),
                    'level' => $this->accountService->getLevelById($viewAccount->getLevel())
                ]
            )
        );
    }

    public function manage(ServerRequestInterface $request, Account $account): void
    {
        if (isset($_POST['adminAccountTabSettingsSaveButton'], $_POST['adminAccountTabSettingsFirstname'], $_POST['adminAccountTabSettingsSurname']) &&
            !empty($_POST['adminAccountTabSettingsAccountName']) &&
            !empty($_POST['adminAccountTabSettingsEmail']) &&
            !empty($_POST['adminAccountTabSettingsAccountLevel'])
        ) {
            $account->setName($_POST['adminAccountTabSettingsAccountName']);
            $account->setFirstname($_POST['adminAccountTabSettingsFirstname']);
            $account->setSurname($_POST['adminAccountTabSettingsSurname']);
            $account->setEmail($_POST['adminAccountTabSettingsEmail']);
            $account->setLevel((int)$_POST['adminAccountTabSettingsAccountLevel']);
            $account->setActive(isset($_POST['adminAccountTabSettingsActive']));
            $account->setSupport(isset($_POST['adminAccountTabSettingsSupport']));
            $account->setAdmin(isset($_POST['adminAccountTabSettingsAdmin']));

            $this->accountService->updateAccount($account, true);
        }

        if (isset($_POST['adminAccountTabSettingsResendActivationMailButton'])) {
            if ($account->isActive()) {
                MESSAGES->add('warning', 'admin-account-resend-activation-mail-not-necessary');
                return;
            }

            $token = $this->accountService->generateActivationToken($account);

            $this->mailerService->configureMail(
                $account->getEmail(),
                'Konto aktivieren',
                MailType::ACTIVATION_MAIL_ID,
                ['name' => $account->getName(), 'token' => $token->getToken()],
                $account->getId()
            )->send();

            MESSAGES->add('success', 'admin-account-resend-activation-mail-successful');
        }

        if (isset($_POST['adminAccountTabSettingsResetPasswordMailButton'])) {
            $token = $this->accountService->resetPassword($account);
            if (!$token instanceof Token) {
                return;
            }

            $this->mailerService->configureMail(
                $account->getEmail(),
                'Reset Password',
                MailType::RESET_PASSWORD_MAIL_ID,
                ['token' => $token->getToken(), 'requestedByAdmin' => true],
                $account->getId()
            )->send();

            MESSAGES->add('success', 'admin-account-reset-mail-successful');
        }

    }

}
