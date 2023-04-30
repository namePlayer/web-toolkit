<?php declare(strict_types=1);

namespace App\DTO\UrlShortener;

class ShortlinkSearchDTO
{

    private int $id;
    private int $account;
    private string $domain;
    private string $shortcode;
    private int $resultLimit;

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

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function getShortcode(): string
    {
        return $this->shortcode;
    }

    public function setShortcode(string $shortcode): void
    {
        $this->shortcode = $shortcode;
    }

    public function getResultLimit(): int
    {
        return $this->resultLimit;
    }

    public function setResultLimit(int $resultLimit): void
    {
        $this->resultLimit = $resultLimit;
    }

}
