<?php
declare(strict_types=1);

namespace App\Service\Authentication;

use App\Model\Authentication\AccountAddress;
use App\Table\Authentication\AccountAddressTable;

class AccountAddressService
{

    public function __construct(
        private readonly AccountAddressTable $accountAddressTable,
        private readonly AccountService $accountService
    )
    {
    }

    public function findAllAddressesByAccountId(int $accountId): array
    {
        $addressList = $this->accountAddressTable->findAllByAccountId($accountId);
        $addressModelList = [];
        foreach ($addressList as $address) {
            $addressModelList[] = $this->createAccountAddressModelFromArray($address);
        }
        return $addressModelList;
    }

    private function createAccountAddressModelFromArray(array $data): AccountAddress
    {
        $accountAddress = new AccountAddress();
        $accountAddress->setId((int)$data['id']);
        $accountAddress->setAccount((int)$data['account']);
        $accountAddress->setFirstname($data['firstname']);
        $accountAddress->setLastname($data['lastname']);
        $accountAddress->setStreet($data['street']);
        $accountAddress->setHouseNumber($data['house_number']);
        $accountAddress->setZipCode($data['zip_code']);
        $accountAddress->setCity($data['city']);
        $accountAddress->setCountry($data['country']);
        $accountAddress->setPhone($data['phone']);
        return $accountAddress;
    }

}
