<?php declare(strict_types=1);

namespace App\Table\ApiKey;

use App\Model\ApiKey\ApiKey;
use App\Software;
use App\Table\AbstractTable;
use http\Params;

class ApiKeyTable extends AbstractTable
{

    public function insert(ApiKey $apiKey)
    {
        $values = [
            'account' => $apiKey->getAccount(),
            'password' => $apiKey->getPassword(),
            'expires' => null,
            'active' => $apiKey->isActive() === true ? 1 : 0
        ];

        if($apiKey->getExpires() !== NULL)
        {
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

}
