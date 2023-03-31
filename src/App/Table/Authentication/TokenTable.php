<?php declare(strict_types=1);

namespace App\Table\Authentication;

use App\Model\Authentication\Token;
use App\Software;
use App\Table\AbstractTable;

class TokenTable extends AbstractTable
{

    public function insert(Token $token): bool|array
    {
        $values = [
            'type' => $token->getType(),
            'account' => $token->getAccount(),
            'expiry' => $token->getExpiry()->format(Software::DATABASE_TIME_FORMAT),
            'token' => $token->getToken()
        ];

        return $this->query->insertInto($this->getTableName())->values($values)->executeWithoutId();
    }

    public function findByToken(string $token): array|bool
    {

        return $this->query->from($this->getTableName())->where('token', $token)->fetch();

    }

    public function updateUsed(int $token, bool $used): string|int|bool
    {

        return $this->query->update($this->getTableName())->where('id', $token)->set(['used' => $used ? 1 : 0])->execute();

    }

}
