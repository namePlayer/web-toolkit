<?php

declare(strict_types=1);

namespace App\Service\Authentication;

use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Authentication\TokenType;
use App\Table\Authentication\AccountLevelTable;
use App\Table\Authentication\AccountTable;
use App\Validation\Authentication\PasswordResetValidation;
use App\Validation\Authentication\RegisterValidation;
use App\Validation\Authentication\SetNewPasswordValidation;
use DateInterval;
use DateTime;
use Monolog\Level;
use Monolog\Logger;

readonly class AccountService
{

    public function __construct(
        private AccountTable $accountTable,
        private PasswordService $passwordService,
        private RegisterValidation $registerValidation,
        private AccountLevelTable $accountLevelTable,
        private PasswordResetValidation $passwordResetValidation,
        private SetNewPasswordValidation $setNewPasswordValidation,
        private TokenService $tokenService,
        private Logger $logger
    ) {
    }

    public function updateLastUserLogin(Account $account): void
    {
        $account->setLastLogin(new DateTime());

        $this->accountTable->updateLastLogin($account);
    }

    public function create(Account $account): bool
    {
        if ($this->registerValidation->verify($account) === false) {
            $this->logger->log(Level::Info, 'Registration Data Validation failed', MESSAGES->getAll());
            return false;
        }

        if ($this->findAccountByEmail($account->getEmail()) !== false) {
            MESSAGES->add('danger', 'email-invalid');
            $this->logger->log(Level::Info, 'Registration Email is already used');
            return false;
        }

        $account->setPassword($this->passwordService->hashPassword($account->getPassword()));
        if ($this->accountTable->insert($account) !== false) {
            $account->setId($this->findAccountByEmail($account->getEmail())['id']);

            if ($account->getBusiness() !== null) {
                $this->accountTable->setAccountBusinessByAccountId($account->getId(), $account->getId());
                $account->setBusiness($account->getId());
            }

            MESSAGES->add('success', 'account-created');
            $this->logger->log(Level::Info, 'Account creation was successful', [
                    'name' => $account->getName(),
                    'email' => $account->getEmail(),
                    'business-account' => $account->getBusiness()
                ]
            );
            return true;
        }

        return false;
    }

    public function updateAccount(Account $account): void
    {
        if ($this->accountTable->updateAccountInformation($account) > 0) {
            MESSAGES->add('success', 'admin-account-update-successful');
            return;
        }

        MESSAGES->add('danger', 'admin-account-update-failed');
    }

    public function resetPassword(Account $account): bool|Token
    {
        if ($this->passwordResetValidation->verify($account) === false) {
            return false;
        }

        $accountData = $this->findAccountByEmail($account->getEmail());

        $token = new Token();
        if ($accountData === false) {
            return $token;
        }

        $token->setAccount($accountData['id']);
        $token->setExpiry((new DateTime())->add(new DateInterval('PT1H')));
        $token->setType(TokenType::RESET_PASSWORD_TOKEN);

        $this->tokenService->create($token);

        return $token;
    }

    public function setNewPassword(Account $account, string $passwordCheck): bool
    {
        if ($this->setNewPasswordValidation->verify($account, $passwordCheck) === false) {
            return false;
        }

        $account->setPassword($this->passwordService->hashPassword($account->getPassword()));

        if ($this->accountTable->updateAccountPassword($account->getId(), $account->getPassword()) > 0) {
            return true;
        }

        return false;
    }

    public function generateActivationToken(Account $account): Token
    {
        $token = new Token();
        $token->setAccount($account->getId());
        $token->setType(TokenType::ACTIVATION_TOKEN);
        $token->setExpiry((new DateTime())->add(new DateInterval('PT1H')));

        $this->tokenService->create($token);
        return $token;
    }

    public function setAccountActive(int $account, bool $active): void
    {
        $this->accountTable->updateAccountActive($account, $active);
    }

    public function getLevelById(int $level): array
    {
        return $this->accountLevelTable->findById($level);
    }

    public function findAccountByEmail(string $email): array|false
    {
        return $this->accountTable->findByEmail($email);
    }

    public function findAccountById(int $id): array|false
    {
        return $this->accountTable->findById($id);
    }

    public function getAllAccountsCount(): int
    {
        return (int)$this->accountTable->countAllUsers();
    }

    public function getAccountList(): array
    {
        return $this->accountTable->findAll();
    }

    public function setSendLoginEmail(int $account, bool $active): void
    {
        $this->accountTable->updateAccountSendMailUnknownLogin($account, $active);
    }


}
