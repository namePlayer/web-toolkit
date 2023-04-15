<?php

namespace App\Model\UrlShortener;

use DateTime;

class ShortlinkTracking
{

    private int $id;
    private int $link;
    private string $useragent;
    private string $userIp;
    private DateTime $accessed;
    private string $browser;
    private string $operatingSystem;
    private string $country;
    private string $device;
    private string $referer;

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

    public function getAccessed(): DateTime
    {
        return $this->accessed;
    }

    public function setAccessed(DateTime $accessed): void
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

    /**
     * @return string
     */
    public function getDevice(): string
    {
        return $this->device;
    }

    /**
     * @param string $device
     */
    public function setDevice(string $device): void
    {
        $this->device = $device;
    }

    /**
     * @return string
     */
    public function getReferer(): string
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer(string $referer): void
    {
        $this->referer = $referer;
    }

}
