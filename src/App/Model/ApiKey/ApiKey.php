<?php

namespace App\Model\ApiKey;

class ApiKey
{

    private int $id;
    private ?int $account = null;
    private string $password;
    private \DateTime $created;
    private ?\DateTime $expires = null;
    private bool $active;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAccount(): ?int
    {
        return $this->account;
    }

    public function setAccount(?int $account): void
    {
        $this->account = $account;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getExpires(): ?\DateTime
    {
        return $this->expires;
    }

    public function setExpires(?\DateTime $expires): void
    {
        $this->expires = $expires;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}
