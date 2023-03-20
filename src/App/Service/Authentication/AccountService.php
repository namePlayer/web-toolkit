<?php
declare(strict_types=1);

namespace App\Service\Authentication;

use App\Model\Authentication\Account;
use App\PlatesExtension\Message\MessageList;
use App\Table\Authentication\AccountTable;
use App\Validation\Authentication\RegisterValidation;
use Monolog\Level;
use Monolog\Logger;

class AccountService
{

    public function __construct(
        private readonly AccountTable $accountTable,
        private readonly PasswordService $passwordService,
        private readonly RegisterValidation $registerValidation,
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

}
