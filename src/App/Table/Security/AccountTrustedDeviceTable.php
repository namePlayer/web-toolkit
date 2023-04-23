<?php declare(strict_types=1);

namespace App\Table\Security;

use App\Model\Security\AccountTrustedDevice;
use App\Table\AbstractTable;

class AccountTrustedDeviceTable extends AbstractTable
{

    public function insert(AccountTrustedDevice $accountTrustedDevice): array|bool
    {
        $values = [
            'account' => $accountTrustedDevice->getAccount(),
            'ip' => $accountTrustedDevice->getIpAddress()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findByAccountAndTrustedIp(int $account, string $ip): array|bool
    {
        return $this->query->from($this->getTableName())->where(['account' => $account, 'ip' => $ip])->fetch();
    }

    public function findAllByAccount(int $account): array|bool
    {
        return $this->query->from($this->getTableName())->where('account', $account)->fetchAll();
    }

}
