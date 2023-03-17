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
            'accessed' => $shortlinkTracking->getAccessed()->format(Software::DATABASE_TIME_FORMAT)
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();

    }

}