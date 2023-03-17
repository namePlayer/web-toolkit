<?php

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\ShortlinkTracking;
use App\Table\UrlShortener\ShortlinkTrackingTable;
use DeviceDetector\DeviceDetector;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class ShortlinkTrackingService
{

    public function __construct(
        private readonly ShortlinkTrackingTable $shortlinkTrackingTable
    )
    {
    }

    public function track(ShortlinkTracking $tracking)
    {

        $userAgent = new DeviceDetector($tracking->getUseragent());
        $userAgent->parse();

        $locationReader = new Reader(__DIR__ . '/../../../../data/countrydatabase.mmdb');
        try {
            $record = $locationReader->country($tracking->getUserIp());
            $tracking->setCountry($record->country->name);
        } catch (AddressNotFoundException $addressNotFoundException)
        {
            $tracking->setCountry('');
        }

        $tracking->setBrowser($userAgent->getClient('name'));
        $tracking->setOperatingSystem($userAgent->getOs('name'));

        $this->shortlinkTrackingTable->create($tracking);

    }

}