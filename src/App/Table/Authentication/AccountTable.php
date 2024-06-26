<?php

declare(strict_types=1);

namespace App\Table\Authentication;

use App\Model\Authentication\Account;
use App\Software;
use App\Table\AbstractTable;

class AccountTable extends AbstractTable
{

    public function insert(Account $account): bool|array|int
    {
        $values = [
            'name' => $account->getName(),
            'email' => $account->getEmail(),
            'password' => $account->getPassword()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findByEmail(string $email): array|bool
    {
        return $this->query->from($this->getTableName())->where(['email' => $email])->fetch();
    }

    public function updateLastLogin(Account $account): array|bool
    {
        $value = [
            'lastLogin' => $account->getLastLogin()->format(Software::DATABASE_TIME_FORMAT)
        ];

        return $this->query->update($this->getTableName())->where('id', $account->getId())->set($value)->execute() === 1;
    }

    public function updateAccountInformation(Account $account): string|int|bool
    {
        $value = [
            'level' => $account->getLevel(),
            'name' => $account->getName(),
            'firstname' => $account->getFirstname(),
            'surname' => $account->getSurname(),
            'email' => $account->getEmail(),
            'business' => $account->getBusiness(),
            'active' => $account->isActive() ? 1 : 0,
            'isSupport' => $account->isSupport() ? 1 : 0,
            'isAdmin' => $account->isAdmin() ? 1 : 0,
            'defaultShippingAddress' => $account->getDefaultShippingAddress(),
            'defaultInvoiceAddress' => $account->getDefaultInvoiceAddress()
        ];

        return $this->query->update($this->getTableName())->where('id', $account->getId())->set($value)->execute();
    }

    public function setAccountBusinessByAccountId(?int $business, int $account): array|false|int
    {
        return $this->query->update($this->getTableName())->where('id', $account)->set('business', $business)->execute();
    }

    public function countAllUsers(array $filters = []): int|string
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(*)')->where(
            $filters
        )->fetchColumn();
    }

    public function updateAccountPassword(int $account, string $passwordHash): int|string|bool
    {
        return $this->query->update($this->getTableName())->where('id', $account)->set(['password' => $passwordHash]
        )->execute();
    }

    public function updateAccountActive(int $account, bool $active): int|string|bool
    {
        return $this->query->update($this->getTableName())->where('id', $account)->set(['active' => $active ? 1 : 0]
        )->execute();
    }

    public function updateAccountSendMailUnknownLogin(int $account, bool $active): int|string|bool
    {
        return $this->query->update($this->getTableName())->where('id', $account)->set(['sendMailUnknownLogin' => $active ? 1 : 0]
        )->execute();
    }

    public function findAllWithSearch(array $search): bool|array
    {
        return $this->query->from($this->getTableName())->select('a.name as businessName')->leftJoin(
            'Account a on a.id = Account.business'
        )->where($search)->orderBy('Account.registered DESC')->fetchAll();
    }

    public function updateAccountOrganisation(int $account, ?int $organisation): bool|array|string|int
    {
        return $this->query->update($this->getTableName())->where('id', $account)->set('business', $organisation)->execute();
    }

    public function findAllWithSupportOrAdmin(): bool|array
    {
        $query = $this->query->from($this->getTableName())->where('isSupport = 1 OR isAdmin = 1');
        return $query->fetchAll();
    }

}
