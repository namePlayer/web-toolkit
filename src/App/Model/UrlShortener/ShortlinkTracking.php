<?php
declare(strict_types=1);

namespace App\Model\UrlShortener;

class ShortlinkTracking
{

    private int $id;
    private int $link;
    private string $useragent;
    private string $userIp;
    private \DateTime $accessed;
    private string $browser;
    private string $operatingSystem;
    private string $country;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLink(): int
    {
        return $this->link;
    }

    public function setLink(int $link): void
    {
        $this->link = $link;
    }

    public function getUseragent(): string
    {
        return $this->useragent;
    }

    public function setUseragent(string $useragent): void
    {
        $this->useragent = $useragent;
    }

    public function getUserIp(): string
    {
        return $this->userIp;
    }

    public function setUserIp(string $userIp): void
    {
        $this->userIp = $userIp;
    }

    public function getAccessed(): \DateTime
    {
        return $this->accessed;
    }

    public function setAccessed(\DateTime $accessed): void
    {
        $this->accessed = $accessed;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }

    public function setBrowser(string $browser): void
    {
        $this->browser = $browser;
    }

    public function getOperatingSystem(): string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): void
    {
        $this->operatingSystem = $operatingSystem;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

}
