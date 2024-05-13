<?php
declare(strict_types=1);

namespace App\Table\Authentication;

use App\Table\AbstractTable;

class AccountAddressTable extends AbstractTable
{

    public function findAllByAccountId(int $accountId): array|bool
    {
        return $this->query->from($this->getTableName())->where('account', $accountId)->fetchAll();
    }

}
