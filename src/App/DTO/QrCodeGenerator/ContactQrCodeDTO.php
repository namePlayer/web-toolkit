<?php

namespace App\DTO\QrCodeGenerator;

class ContactQrCodeDTO
{

    private string $forename;
    private string $surname;
    private string $organisation;
    private string $job;
    private string $website;
    private string $phoneMobile;
    private string $phoneLandline;
    private string $fax;
    private string $street;
    private string $zipCode;
    private string $city;
    private string $state;
    private string $country;

    public function getForename(): string
    {
        return $this->forename;
    }

    public function setForename(string $forename): void
    {
        $this->forename = $forename;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getOrganisation(): string
    {
        return $this->organisation;
    }

    public function setOrganisation(string $organisation): void
    {
        $this->organisation = $organisation;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function getPhoneMobile(): string
    {
        return $this->phoneMobile;
    }

    public function setPhoneMobile(string $phoneMobile): void
    {
        $this->phoneMobile = $phoneMobile;
    }

    public function getPhoneLandline(): string
    {
        return $this->phoneLandline;
    }

    public function setPhoneLandline(string $phoneLandline): void
    {
        $this->phoneLandline = $phoneLandline;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
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
