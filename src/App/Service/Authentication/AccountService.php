<?php

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

    public function create(Account $account)
    {
        if($this->registerValidation->verify($account) === FALSE)
        {
            $this->logger->log(Level::Info, 'Registration Data Validation failed', MESSAGES->getAll());
            return;
        }

        if($this->findAccountByEmail($account->getEmail()) === FALSE)
        {
            MESSAGES->add('danger', 'email-invalid');
            $this->logger->log(Level::Info, 'Registration Email is already used');
            return;
        }

        $account->setPassword($this->passwordService->hashPassword($account->getPassword()));
        if($this->accountTable->insert($account) !== FALSE)
        {
            MESSAGES->add('success', 'account-created');
            $this->logger->log(Level::Info, 'Account creation was successful', [
                    'name' => $account->getName(),
                    'email' => $account->getEmail(),
                    'business-account' => $account->isBusiness()
                ]
            );
            return;
        }

    }

    private function findAccountByEmail(string $email): array|false
    {
        return $this->accountTable->findByEmail($email);
    }

    private function findAccountById(int $id): array|false
    {
        return $this->accountTable->findById($id);
    }

}
