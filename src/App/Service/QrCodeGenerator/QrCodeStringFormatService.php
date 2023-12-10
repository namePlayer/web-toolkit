<?php

namespace App\Service\QrCodeGenerator;

use App\DTO\QrCodeGenerator\ContactQrCodeDTO;
use App\DTO\QrCodeGenerator\EmailQrCodeDTO;
use App\DTO\QrCodeGenerator\WifiQrCodeDTO;

readonly class QrCodeStringFormatService
{

    public function createWifiFormatString(WifiQrCodeDTO $wifiQrCodeDTO): string
    {
        return
            'WIFI:T:' . $wifiQrCodeDTO->getEncryption() .
            ';S:' . $wifiQrCodeDTO->getNetworkName() .
            ';P:' . $wifiQrCodeDTO->getPassword() .
            ';' . ($wifiQrCodeDTO->isHidden() ? 'H:true' : '') . ';';
    }

    public function createContactFormatString(ContactQrCodeDTO $contactQrCodeDTO): string
    {
        $vcard = "BEGIN:VCARD\n";

        if($contactQrCodeDTO->getForename() !== "" || $contactQrCodeDTO->getSurname() !== "") {
            $vcard .= "N:" . $contactQrCodeDTO->getForename() . ";" . $contactQrCodeDTO->getSurname() . ";\n";
        }

        if(!empty($contactQrCodeDTO->getOrganisation()))
        {
            $vcard .= "ORG:" . $contactQrCodeDTO->getOrganisation() . "\n";
        }

        if(!empty($contactQrCodeDTO->getJob()))
        {
            $vcard .= "TITLE:" . $contactQrCodeDTO->getJob() . "\n";
        }

        if(!empty($contactQrCodeDTO->getWebsite()))
        {
            $vcard .=  "URL:" . $contactQrCodeDTO->getWebsite() . "\n";
        }

        if(!empty($contactQrCodeDTO->getEmail()))
        {
            $vcard .= "EMAIL:" . $contactQrCodeDTO->getEmail() . "\n";
        }

        if(!empty($contactQrCodeDTO->getPhoneLandline()))
        {
            $vcard .= "TEL;TYPE=work,VOICE:" . $contactQrCodeDTO->getPhoneLandline() . "\n";
        }

        if(!empty($contactQrCodeDTO->getPhoneMobile()))
        {
            $vcard .= "TEL;TYPE=home,VOICE:" . $contactQrCodeDTO->getPhoneMobile() . "\n";
        }

        if(!empty($contactQrCodeDTO->getFax()))
        {
            $vcard .= "TEL;TYPE=fax:" . $contactQrCodeDTO->getFax() . "\n";
        }

        if(!empty($contactQrCodeDTO->getStreet()) || !empty($contactQrCodeDTO->getCity()) || !empty($contactQrCodeDTO->getState()) || !empty($contactQrCodeDTO->getZipCode()) || !empty($contactQrCodeDTO->getCountry()))
        {
            $vcard .= "ADR;TYPE=WORK,PREF:;;" . $contactQrCodeDTO->getStreet() . ";" . $contactQrCodeDTO->getCity() .
                ";" . $contactQrCodeDTO->getState() . ";" . $contactQrCodeDTO->getZipCode() . ";" . $contactQrCodeDTO->getCountry() . "\n";
        }

        $vcard .= "VERSION:3.0\nEND:VCARD";

        return $vcard;
    }

    public function createEmailFormatString(EmailQrCodeDTO $emailQrCodeDTO): string
    {
        return 'mailto:' . $emailQrCodeDTO->getRecipient() . '?subject=' . $emailQrCodeDTO->getSubject() . '&body=' . $emailQrCodeDTO->getMessage();
    }

}
