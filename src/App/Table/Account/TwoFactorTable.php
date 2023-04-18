<?php declare(strict_types=1);

namespace App\Table\Account;

use App\Model\Authentication\TwoFactor;
use App\Table\AbstractTable;

class TwoFactorTable extends AbstractTable
{

    public function insert(TwoFactor $twoFactor)
    {
        $values = [
            'type' => $twoFactor->getType(),
            'account' => $twoFactor->getAccount(),
            'name' => $twoFactor->getName(),
            'secret' => $twoFactor->getSecret()
        ];

        $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findAllTwoFactorsByAccount(int $account): array|false
    {
        return $this->query->from($this->getTableName())->where('account', $account)->fetchAll();
    }

}
