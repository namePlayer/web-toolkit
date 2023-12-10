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
        return
            "BEGIN:VCARD\n" .
            "N:".$contactQrCodeDTO->getForename().";".$contactQrCodeDTO->getSurname().";\n" .
            "TEL;TYPE=work,VOICE:" . $contactQrCodeDTO->getPhoneLandline() . "\n" .
            "TEL;TYPE=home,VOICE:" . $contactQrCodeDTO->getPhoneMobile() . "\n" .
            "TEL;TYPE=fax:" . $contactQrCodeDTO->getFax() . "\n" .
            "EMAIL:" . $contactQrCodeDTO->getEmail() . "\n" .
            "ORG:" . $contactQrCodeDTO->getOrganisation() . "\n" .
            "TITLE:" . $contactQrCodeDTO->getJob() . "\n" .
            "ADR;TYPE=WORK,PREF:;;" . $contactQrCodeDTO->getStreet() . ";" . $contactQrCodeDTO->getCity() .
            ";" . $contactQrCodeDTO->getState() . ";" . $contactQrCodeDTO->getZipCode() . ";" . $contactQrCodeDTO->getCountry() . "\n" .
            "URL:" . $contactQrCodeDTO->getWebsite() . "\n" .
            "VERSION:3.0\n" .
            "END:VCARD";
    }

    public function createEmailFormatString(EmailQrCodeDTO $emailQrCodeDTO): string
    {
        return 'mailto:' . $emailQrCodeDTO->getRecipient() . '?subject=' . $emailQrCodeDTO->getSubject() . '&body=' . $emailQrCodeDTO->getMessage();
    }

}
