<?php declare(strict_types=1);

namespace App\DTO\UrlShortener;

class ShortlinkDeleteDTO
{

    private int $id;
    private string $verificationCode;
    private string $input;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getVerificationCode(): string
    {
        return $this->verificationCode;
    }

    public function setVerificationCode(string $verificationCode): void
    {
        $this->verificationCode = $verificationCode;
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function setInput(string $input): void
    {
        $this->input = $input;
    }

}
