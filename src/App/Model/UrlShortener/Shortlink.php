<?php

namespace App\Model\UrlShortener;

use DateTime;

class Shortlink
{

    private int $id;
    private ?int $domain = null;
    private string $uuid = '';
    private ?int $account;
    private DateTime $dateTime;
    private string $destination;
    private ?DateTime $expiryDate = null;
    private ?string $password = null;
    private bool $tracking = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDomain(): ?int
    {
        return $this->domain;
    }

    public function setDomain(?int $domain): void
    {
        $this->domain = $domain;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getAccount(): ?int
    {
        return $this->account;
    }

    public function setAccount(?int $account): void
    {
        $this->account = $account;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): void
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

    public function getExpiryDate(): ?DateTime
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(?DateTime $expiryDate): void
    {
        $this->expiryDate = $expiryDate;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function isTracking(): bool
    {
        return $this->tracking;
    }

    public function setTracking(bool $tracking): void
    {
        $this->tracking = $tracking;
    }

}
