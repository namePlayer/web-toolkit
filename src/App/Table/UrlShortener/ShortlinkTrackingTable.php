<?php

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
            'useragent' => $shortlinkTracking->getUseragent(),
            'userIp' => $shortlinkTracking->getUserIp(),
            'accessed' => $shortlinkTracking->getAccessed()->format(Software::DATABASE_TIME_FORMAT),
            'browser' => $shortlinkTracking->getBrowser(),
            'operatingSystem' => $shortlinkTracking->getOperatingSystem(),
            'country' => $shortlinkTracking->getCountry()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();

    }

    public function getTracksByLinkIdAndLimit(int $link, int $limit): array
    {

        $where = [
            'link' => $link
        ];

        return $this->query->from($this->getTableName())->where($where)->limit($limit)->orderBy('accessed DESC')->fetchAll();

    }

    public function countAllByLink(int $link): bool|array|int
    {

        return $this->query->from($this->getTableName())->select(null)->select('COUNT(id)')->where('link', $link)->fetchColumn();

    }

}