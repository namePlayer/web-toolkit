<?php
declare(strict_types=1);

namespace App\Service\Authentication;

use App\Model\Authentication\Account;
use App\Model\Authentication\Token;
use App\Model\Authentication\TokenType;
use App\PlatesExtension\Message\MessageList;
use App\Table\Authentication\AccountLevelTable;
use App\Table\Authentication\AccountTable;
use App\Validation\Authentication\PasswordResetValidation;
use App\Validation\Authentication\RegisterValidation;
use App\Validation\Authentication\SetNewPasswordValidation;
use Monolog\Level;
use Monolog\Logger;

class AccountService
{

    public function __construct(
        private readonly AccountTable $accountTable,
        private readonly PasswordService $passwordService,
        private readonly RegisterValidation $registerValidation,
        private readonly AccountLevelTable $accountLevelTable,
        private readonly PasswordResetValidation $passwordResetValidation,
        private readonly SetNewPasswordValidation $setNewPasswordValidation,
        private readonly TokenService $tokenService,
        private readonly Logger $logger
    )
    {
    }

    public function updateLastUserLogin(Account $account): void
    {
        $account->setLastLogin(new \DateTime());

        $this->accountTable->updateLastLogin($account);

    }

    public function create(Account $account)
    {
        if($this->registerValidation->verify($account) === FALSE)
        {
            $this->logger->log(Level::Info, 'Registration Data Validation failed', MESSAGES->getAll());
            return;
        }

        if($this->findAccountByEmail($account->getEmail()) !== FALSE)
        {
            MESSAGES->add('danger', 'email-invalid');
            $this->logger->log(Level::Info, 'Registration Email is already used');
            return;
        }

        $account->setPassword($this->passwordService->hashPassword($account->getPassword()));
        if($this->accountTable->insert($account) !== FALSE)
        {
            if($account->getBusiness() !== NULL)
            {
                $accountId = $this->findAccountByEmail($account->getEmail())['id'];
                $this->accountTable->setAccountBusinessByAccountId($accountId, $accountId);
                $account->setBusiness($accountId);
            }

            MESSAGES->add('success', 'account-created');
            $this->logger->log(Level::Info, 'Account creation was successful', [
                    'name' => $account->getName(),
                    'email' => $account->getEmail(),
                    'business-account' => $account->getBusiness()
                ]
            );
            return;
        }

    }

    public function updateAccount(Account $account): void
    {

        if($this->accountTable->updateAccountInformation($account) > 0)
        {
            MESSAGES->add('success', 'admin-account-update-successful');
            return;
        }

        MESSAGES->add('danger', 'admin-account-update-failed');
        return;
    }

    public function resetPassword(Account $account): bool
    {

        if($this->passwordResetValidation->verify($account) === FALSE)
        {
            return false;
        }

        $accountData = $this->findAccountByEmail($account->getEmail());

        if($accountData === FALSE)
        {
            return true;
        }

        $token = new Token();
        $token->setAccount($accountData['id']);
        $token->setExpiry((new \DateTime())->add(new \DateInterval('PT1H')));
        $token->setType(TokenType::RESET_PASSWORD_TOKEN);

        $this->tokenService->create($token);

        return true;
    }

    public function setNewPassword(Account $account, string $passwordCheck): bool
    {

        if($this->setNewPasswordValidation->verify($account, $passwordCheck) === FALSE)
        {
            return false;
        }

        $account->setPassword($this->passwordService->hashPassword($account->getPassword()));

        if($this->accountTable->updateAccountPassword($account->getId(), $account->getPassword()) > 0)
        {
            return true;
        }

        return false;

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

}
