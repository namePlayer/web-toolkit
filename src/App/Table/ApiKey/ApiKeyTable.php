<?php declare(strict_types=1);

namespace App\Table\ApiKey;

use App\Table\AbstractTable;

class ApiKeyTable extends AbstractTable
{

    public function getAllApiKeysWithUsername(): array
    {

            return $this->query->from($this->getTableName())
                ->leftJoin('Account on Account.id = ApiKey.account')
                ->select('Account.name')
                ->fetchAll();

    }

}
