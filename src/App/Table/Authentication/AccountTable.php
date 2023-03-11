<?php

namespace App\Table\Authentication;

use App\Model\Authentication\Account;
use App\Table\AbstractTable;

class AccountTable extends AbstractTable
{

    public function insert(Account $account): bool|array
    {

        $values = [
            'name' => $account->getName(),
            'email' => $account->getEmail(),
            'password' => $account->getPassword(),
            'business' => $account->isBusiness() ? 1 : 0
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findByEmail(string $email): array|bool
    {
        return $this->query->from($this->getTableName())->where(['email' => $email])->fetch();
    }

}