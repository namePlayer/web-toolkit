<?php

namespace App\DTO\QrCodeGenerator;

class WifiQrCodeDTO
{

    private string $networkName;
    private string $encryption;
    private string $password;
    private bool $hidden;

    public function getNetworkName(): string
    {
        return $this->networkName;
    }

    public function setNetworkName(string $networkName): void
    {
        $this->networkName = $networkName;
    }

    public function getEncryption(): string
    {
        return $this->encryption;
    }

    public function setEncryption(string $encryption): void
    {
        $this->encryption = $encryption;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

}
