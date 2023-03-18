<?php

namespace App\Table\UrlShortener;

use App\Model\UrlShortener\ShortlinkDomain;
use App\Table\AbstractTable;

class ShortlinkDomainTable extends AbstractTable
{

    public function insert(ShortlinkDomain $shortlinkDomain): int|bool
    {

        $values = [
            'user' => $shortlinkDomain->getUser(),
            'uuid' => $shortlinkDomain->getUuid(),
            'address' => $shortlinkDomain->getAddress(),
            'public' => $shortlinkDomain->isPublic()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->execute();

    }

}