<?php
declare(strict_types=1);

namespace App\Table\ApiKey;

use App\Model\ApiKey\ApiKey;
use App\Software;
use App\Table\AbstractTable;

class ApiKeyTable extends AbstractTable
{

    public function insert(ApiKey $apiKey): bool|int
    {
        $values = [
            'account' => $apiKey->getAccount(),
            'password' => $apiKey->getPassword(),
            'expires' => null,
            'active' => $apiKey->isActive() === true ? 1 : 0
        ];

        if ($apiKey->getExpires() !== null) {
            $values['expires'] = $apiKey->getExpires()->format(Software::DATABASE_TIME_FORMAT);
        }

        return $this->query->insertInto($this->getTableName())->values($values)->execute();
    }

    public function getAllApiKeysWithUsername(): array
    {
        return $this->query->from($this->getTableName())
            ->leftJoin('Account on Account.id = ApiKey.account')
            ->select('Account.name')
            ->fetchAll();
    }

    public function findByPassword(string $password): array|false
    {
        return $this->query->from($this->getTableName())->where('password', $password)->fetch();
    }

    public function updateActive(int $key, bool $active): string|int|bool
    {
        return $this->query->update($this->getTableName())->where('id', $key)->set('active', $active ? 1 : 0)->execute(
        );
    }

    public function updateKey(ApiKey $apiKey): string|int|bool
    {
        $set = [
            'password' => $apiKey->getPassword(),
            'expires' => $apiKey->getExpires()?->format(Software::DATABASE_TIME_FORMAT)
        ];

        return $this->query->update($this->getTableName())->where('id', $apiKey->getId())->set($set)->execute();
    }

}
