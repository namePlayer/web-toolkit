<?php

namespace App\Model\Security;

use DateTime;

class AccountTrustedDevice
{

    private int $id;
    private int $account;
    private string $ipAddress;
    private DateTime $allowed;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAccount(): int
    {
        return $this->account;
    }

    public function setAccount(int $account): void
    {
        $this->account = $account;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getAllowed(): DateTime
    {
        return $this->allowed;
    }

    public function setAllowed(DateTime $allowed): void
    {
        $this->allowed = $allowed;
    }

}
