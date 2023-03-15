<?php

namespace App\Table\UrlShortener;

use App\Model\UrlShortener\Shortlink;
use App\Table\AbstractTable;

class ShortlinkTable extends AbstractTable
{

    public function insert(Shortlink $shortlink)
    {

        $values = [
            'uuid' => $shortlink->getUuid(),
            'destination' => $shortlink->getDestination(),
            'account' => $shortlink->getAccount()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->execute();
    }

    public function findByUUID(string $uuid): array|false
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetch();
    }

    public function findByUUIDAndDomain(Shortlink $shortlink): array|false
    {
        $where = [
            'domain' => $shortlink->getDomain(),
            'uuid' => $shortlink->getUuid()
        ];

        return $this->query->from($this->getTableName())->where($where)->fetch();
    }

}
