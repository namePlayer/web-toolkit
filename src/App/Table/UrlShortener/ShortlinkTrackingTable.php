<?php

declare(strict_types=1);

namespace App\Table\UrlShortener;

use App\Model\UrlShortener\ShortlinkTracking;
use App\Software;
use App\Table\AbstractTable;

class ShortlinkTrackingTable extends AbstractTable
{

    public function create(ShortlinkTracking $shortlinkTracking): bool|array
    {
        $values = [
            'link' => $shortlinkTracking->getLink(),
            'accessed' => $shortlinkTracking->getAccessed()->format(Software::DATABASE_TIME_FORMAT),
            'browser' => $shortlinkTracking->getBrowser(),
            'operatingSystem' => $shortlinkTracking->getOperatingSystem(),
            'country' => $shortlinkTracking->getCountry(),
            'device' => $shortlinkTracking->getDevice(),
            'referer' => $shortlinkTracking->getReferer()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function getTracksByLinkIdAndLimit(int $link, int $limit): array
    {
        $where = [
            'link' => $link
        ];

        return $this->query->from($this->getTableName())->where($where)->limit($limit)->orderBy(
            'accessed DESC'
        )->fetchAll();
    }

    public function countAllByLink(int $link): bool|array|int|string
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(id)')->where(
            'link',
            $link
        )->fetchColumn();
    }

    public function getGroupedBrowserCountByLinkId(int $link, int $limit = 10): array|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('browser,COUNT(*) AS amount')->where('link', $link)
            ->limit($limit)->orderBy('amount DESC')->groupBy('browser')->fetchAll();
    }

    public function getGroupedCountryCountByLinkId(int $link, int $limit = 10): array|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('country,COUNT(*) AS amount')->where('link', $link)
            ->limit($limit)->orderBy('amount DESC')->groupBy('country')->fetchAll();
    }

    public function getGroupedDeviceCountByLinkId(int $link, int $limit = 10): array|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('device,COUNT(*) AS amount')->where('link', $link)
            ->limit($limit)->orderBy('amount DESC')->groupBy('device')->fetchAll();
    }

    public function getGroupedRefererCountByLinkId(int $link, int $limit = 10): array|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('referer,COUNT(*) AS amount')->where('link', $link)
            ->limit($limit)->orderBy('amount DESC')->groupBy('referer')->fetchAll();
    }

}
