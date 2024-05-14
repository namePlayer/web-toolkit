<?php
declare(strict_types=1);

namespace App\Table\Authentication;

use App\Model\Authentication\AccountAddress;
use App\Table\AbstractTable;

class AccountAddressTable extends AbstractTable
{

    public function insert(AccountAddress $accountAddress): bool|int|string
    {
        return $this->query->insertInto($this->getTableName())
            ->values($this->createArrayFromAccountAddressModel($accountAddress))->execute();
    }

    public function update(AccountAddress $accountAddress): bool|int|string
    {
        return $this->query->update($this->getTableName())
            ->set($this->createArrayFromAccountAddressModel($accountAddress))
            ->where('id', $accountAddress->getId())
            ->execute();
    }

    public function findAllByAccountId(int $accountId): array|bool
    {
        return $this->query->from($this->getTableName())->where('account', $accountId)->fetchAll();
    }

    public function findByIdAndAccount(int $id, int $accountId): array|bool
    {
        return $this->query->from($this->getTableName())->where(['id' => $id, 'account' => $accountId])->fetch();
    }

    private function createArrayFromAccountAddressModel(AccountAddress $accountAddress): array
    {
        return [
            'account' => $accountAddress->getAccount(),
            'company' => $accountAddress->getCompany(),
            'firstname' => $accountAddress->getFirstname(),
            'lastname' => $accountAddress->getLastname(),
            'street' => $accountAddress->getStreet(),
            'house_number' => $accountAddress->getHouseNumber(),
            'zip_code' => $accountAddress->getZipCode(),
            'city' => $accountAddress->getCity(),
            'country' => $accountAddress->getCountry(),
            'phone' => $accountAddress->getPhone()
        ];
    }

}
