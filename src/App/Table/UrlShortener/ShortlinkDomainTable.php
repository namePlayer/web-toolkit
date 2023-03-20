<?php
declare(strict_types=1);

namespace App\Table\UrlShortener;

use App\Model\UrlShortener\ShortlinkDomain;
use App\Table\AbstractTable;

class ShortlinkDomainTable extends AbstractTable
{

    public function insert(ShortlinkDomain $shortlinkDomain): int|bool|string
    {

        $values = [
            'user' => $shortlinkDomain->getUser(),
            'uuid' => $shortlinkDomain->getUuid(),
            'address' => $shortlinkDomain->getAddress(),
            'public' => $shortlinkDomain->isPublic() ? 1 : 0
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->execute();

    }

    public function getAllDomainsForUser(int $userId): array|false
    {

        return $this->query->from($this->getTableName())
            ->where('user', $userId)
            ->whereOr('user', null)
            ->where('verified', 1)
            ->whereOr('public', 1)
            ->where('verified', 1)
            ->fetchAll();

    }

    public function findByAddress(string $address): array|false
    {
        return $this->query->from($this->getTableName())->where('address', $address)->fetch();
    }

}
