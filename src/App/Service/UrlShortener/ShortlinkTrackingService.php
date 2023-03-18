<?php

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\Shortlink;
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

        $locationReader = new Reader(__DIR__ . '/../../../../data/persistent/countrydatabase.mmdb');
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

    public function getLastClicksForLink(int $link, int $amount): array
    {

        return $this->shortlinkTrackingTable->getTracksByLinkIdAndLimit($link, $amount);

    }

    public function getClickCountForLink(int $link): ?int
    {
        return $this->shortlinkTrackingTable->countAllByLink($link);

    }

}