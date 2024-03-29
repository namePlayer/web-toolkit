<?php

declare(strict_types=1);

namespace App\Table\UrlShortener;

use App\Model\UrlShortener\Shortlink;
use App\Software;
use App\Table\AbstractTable;

class ShortlinkTable extends AbstractTable
{

    public function insert(Shortlink $shortlink): string|bool|int
    {
        $values = [
            'uuid' => $shortlink->getUuid(),
            'destination' => $shortlink->getDestination(),
            'account' => $shortlink->getAccount(),
            'password' => $shortlink->getPassword(),
            'tracking' => $shortlink->isTracking() ? 1 : 0,
            'domain' => $shortlink->getDomain()
        ];

        if ($shortlink->getExpiryDate() !== null) {
            $values['expiryDate'] = $shortlink->getExpiryDate()->format(Software::DATABASE_TIME_FORMAT);
        }

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

    public function findALlLimitResults(int $maximum): array|false
    {
        return $this->query->from($this->getTableName())->select('ShortlinkDomain.address')->leftJoin(
            'ShortlinkDomain on ShortlinkDomain.id = Shortlink.domain'
        )
            ->orderBy('id DESC')->limit($maximum)->fetchAll();
    }

    public function findAllByAccountId(int $userId): array|false
    {
        return $this->query->from($this->getTableName())->where('account', $userId)->fetchAll();
    }

    public function countAll(): string|int|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(*)')->fetchColumn();
    }

    public function countAllInLastDays(int $days): int|string|bool
    {
        return $this->query->from($this->getTableName())->select(null)->select('COUNT(*)')->where(
            'created between date_sub(now(),INTERVAL ' . $days . ' day) and now()'
        )->fetchColumn();
    }

    public function findBySearchArray(array $search, int $limit): array
    {
        return $this->query->from($this->getTableName())->select(['ShortlinkDomain.address, a.name as accountName'])->leftJoin(
            'ShortlinkDomain on ShortlinkDomain.id = Shortlink.domain'
        )->leftJoin(
            'Account a on a.id = Shortlink.account'
        )->where($search, ['eli'])->limit($limit)->orderBy('created DESC')->fetchAll();
    }

    public function deleteShortlinkById(int $id): int|bool|string
    {
        return $this->query->delete($this->getTableName())->where('id', $id)->execute();
    }

}
