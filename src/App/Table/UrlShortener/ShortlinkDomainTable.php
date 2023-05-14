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

    public function findBySearchArray(array $search, int $limit = 50): array
    {
        return $this->query->from($this->getTableName())->select(['a.name as accountName'])->leftJoin(
            'Account a on a.id = ShortlinkDomain.user'
        )->where($search)->limit($limit)->orderBy('created DESC')->fetchAll();
    }

    public function findByAddress(string $address): array|false
    {
        return $this->query->from($this->getTableName())->where('address', $address)->fetch();
    }

    public function findByUUID(string $uuid)
    {
        return $this->query->from($this->getTableName())->where('uuid', $uuid)->fetch();
    }

    public function findAllWithLimitDescending(int $limit): array
    {
        return $this->query->from($this->getTableName())->order('id DESC')->limit($limit)->fetchAll();
    }

    public function countAll(): int|string|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(*)')->fetchColumn();
    }

    public function updateActivationForDomainID(int $domain, bool $verification): int|bool
    {
        $set = [
            'verified' => $verification ? 1 : 0
        ];

        return $this->query->update($this->getTableName())->where('id', $domain)->set($set)->execute();
    }


    public function updateDisabledForDomainID(int $domain, bool $disabled): int|bool
    {
        $set = [
            'disabled' => $disabled ? 1 : 0
        ];

        return $this->query->update($this->getTableName())->where('id', $domain)->set($set)->execute();
    }

}
