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

    public function create(AccountAddress $accountAddress): bool
    {
        $insertResult = $this->accountAddressTable->insert($accountAddress);
        if($insertResult > 0 && $insertResult !== FALSE)
        {
            $accountAddress->setId((int)$insertResult);
            return true;
        }

        return false;
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

    public function findAddressByIdAndAccount(int $id, int $account): ?AccountAddress
    {
        $addressData = $this->accountAddressTable->findByIdAndAccount($id, $account);
        if($addressData === FALSE || $addressData['account'] !== $account)
        {
            return null;
        }

        return $this->createAccountAddressModelFromArray($addressData);
    }

    private function createAccountAddressModelFromArray(array $data): AccountAddress
    {
        $accountAddress = new AccountAddress();
        $accountAddress->setId((int)$data['id']);
        $accountAddress->setAccount((int)$data['account']);
        $accountAddress->setCompany($data['company']);
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
