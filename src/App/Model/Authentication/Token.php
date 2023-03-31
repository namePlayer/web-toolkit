<?php

namespace App\Model\Authentication;

class Token
{

    private int $id;
    private int $type;
    private int $account;
    private string $token;
    private \DateTime $expiry;
    private \DateTime $created;

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

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getExpiry(): \DateTime
    {
        return $this->expiry;
    }

    public function setExpiry(\DateTime $expiry): void
    {
        $this->expiry = $expiry;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

}