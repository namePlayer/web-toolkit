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

    public function setAccountBusinessByAccountId(?int $business, int $account): array|false|int
    {

        return $this->query->update($this->getTableName())->where('id', $account)->set('business', $business)->execute();

    }

}
