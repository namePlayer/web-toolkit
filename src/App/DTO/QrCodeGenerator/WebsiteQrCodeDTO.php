<?php

namespace App\DTO\QrCodeGenerator;

class WebsiteQrCodeDTO
{

    private string $website;

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

}
