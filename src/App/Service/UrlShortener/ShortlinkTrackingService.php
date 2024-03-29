<?php

declare(strict_types=1);

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\ShortlinkTracking;
use App\Software;
use App\Table\UrlShortener\ShortlinkTrackingTable;
use DeviceDetector\DeviceDetector;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

readonly class ShortlinkTrackingService
{

    public function __construct(
        private ShortlinkTrackingTable $shortlinkTrackingTable
    )
    {
    }

    public function track(ShortlinkTracking $tracking): void
    {
        $userAgent = new DeviceDetector($tracking->getUseragent());
        $userAgent->parse();

        $locationReader = new Reader(Software::PERSISTENT_DIR . '/country-database.mmdb');
        try {
            $record = $locationReader->country($tracking->getUserIp());
            $tracking->setCountry($record->country->name);
        } catch (AddressNotFoundException) {
            $tracking->setCountry('');
        }

        $tracking->setBrowser($userAgent->getClient('name'));
        $tracking->setOperatingSystem($userAgent->getOs('name'));
        $tracking->setDevice($userAgent->getDeviceName());

        $this->shortlinkTrackingTable->create($tracking);
    }

    public function getLinkBrowserAmount(int $link, int $limit = 10): array
    {
        return $this->shortlinkTrackingTable->getGroupedBrowserCountByLinkId($link, $limit);
    }

    public function getLinkCountryAmount(int $link, int $limit = 10): array
    {
        return $this->shortlinkTrackingTable->getGroupedCountryCountByLinkId($link, $limit);
    }

    public function getLinkDeviceAmount(int $link, int $limit = 10): array
    {
        return $this->shortlinkTrackingTable->getGroupedDeviceCountByLinkId($link, $limit);
    }

    public function getLinkRefererAmount(int $link, int $limit = 10): array
    {
        return $this->shortlinkTrackingTable->getGroupedRefererCountByLinkId($link, $limit);
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
