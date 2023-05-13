<?php declare(strict_types=1);

namespace App\Table\Account;

use App\Model\Authentication\TwoFactor;
use App\Table\AbstractTable;

class TwoFactorTable extends AbstractTable
{

    public function insert(TwoFactor $twoFactor): void
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

    public function findTwoFactorByIdAndAccount(int $id, int $account): array|bool
    {
        $where = [
            'id' => $id,
            'account' => $account
        ];

        return $this->query->from($this->getTableName())->where($where)->fetch();
    }

    public function deleteByidAndAccount(int $id, int $account): bool|int|string|array
    {
        $where = [
            'id' => $id,
            'account' => $account
        ];

        return $this->query->delete($this->getTableName())->where($where)->execute();
    }

}
