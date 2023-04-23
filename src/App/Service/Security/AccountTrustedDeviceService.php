<?php declare(strict_types=1);

namespace App\Service\Security;

use App\Model\Security\AccountTrustedDevice;
use App\Table\Security\AccountTrustedDeviceTable;

class AccountTrustedDeviceService
{

    public function __construct(
        private readonly AccountTrustedDeviceTable $accountTrustedDeviceTable
    )
    {
    }

    public function add(AccountTrustedDevice $accountTrustedDevice): bool
    {
        if($this->accountHasTrustedIp($accountTrustedDevice->getAccount(), $accountTrustedDevice->getIpAddress()))
        {
            return false;
        }

        $this->accountTrustedDeviceTable->insert($accountTrustedDevice);
        return true;
    }

    public function accountHasTrustedIp(int $account, string $ip): bool
    {
        return $this->accountTrustedDeviceTable->findByAccountAndTrustedIp($account, $ip) !== false;
    }

    public function getTrustedIpsForAccount(int $account): array
    {
        return $this->accountTrustedDeviceTable->findAllByAccount($account);
    }

}
