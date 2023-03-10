<?php

namespace App\Model\Authentication;

use DateTime;

class Account
{

    private int $id;
    private int $level;
    private string $name;
    private string $email;
    private string $password;
    private DateTime $registered;
    private ?DateTime $lastLogin;
    private ?int $business;
    private bool $active;
    private bool $setupComplete;
    private bool $admin;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRegistered(): DateTime
    {
        return $this->registered;
    }

    public function setRegistered(DateTime $registered): void
    {
        $this->registered = $registered;
    }

    public function getLastLogin(): DateTime
    {
        return $this->lastLogin;
    }

    public function setLastLogin(DateTime $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    public function getBusiness(): ?bool
    {
        return $this->business;
    }

    public function setBusiness(?bool $business): void
    {
        $this->business = $business;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function isSetupComplete(): bool
    {
        return $this->setupComplete;
    }

    public function setSetupComplete(bool $setupComplete): void
    {
        $this->setupComplete = $setupComplete;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): void
    {
        $this->admin = $admin;
    }

}