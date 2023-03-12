<?php

namespace App\Model\Authentication;

class AccountLevel
{

    public const BASIC_LEVEL = 1;
    public const PREMIUM_LEVEL = 2;
    public const PREMIUM_PLUS_LEVEL = 3;
    public const ENTERPRISE_LEVEL = 4;

    private int $id;
    private string $title;
    private bool $business;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isBusiness(): bool
    {
        return $this->business;
    }

    public function setBusiness(bool $business): void
    {
        $this->business = $businessPlan;
    }

}