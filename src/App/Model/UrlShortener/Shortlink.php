<?php

namespace App\Model\UrlShortener;

class Shortlink
{

    private int $id;
    private int $domain;
    private string $uuid;
    private int $account;
    private \DateTime $dateTime;
    private string $destination;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getAccount(): int
    {
        return $this->account;
    }

    public function setAccount(int $account): void
    {
        $this->account = $account;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): void
    {
        $this->destination = $destination;
    }

}