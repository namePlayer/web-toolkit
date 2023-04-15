<?php

namespace App\Service;

use App\Software;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class UserInformationService
{

    private string $useragent;
    private string $ipAddress;
    private Reader $location;
    private DeviceDetector $deviceDetector;

    public function configure(string $ip, string $useragent): self
    {

        $this->useragent = $useragent;
        $this->ipAddress = $ip;
        $this->location = new Reader(Software::PERSISTENT_DIR . '/country-database.mmdb');
        $this->deviceDetector = new DeviceDetector($this->useragent, ClientHints::factory($_SERVER));
        $this->deviceDetector->parse();

        return $this;

    }

    public function getCountry(): string
    {
        try {
            return $this->location->country($this->ipAddress)->country->name;
        } catch (AddressNotFoundException $e) {
            return '';
        }
    }

    public function getBrowser(): string
    {
        return $this->deviceDetector->getClient('name');
    }

    public function getIP(): string
    {
        return $this->ipAddress;
    }

}