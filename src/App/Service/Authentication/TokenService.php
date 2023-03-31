<?php declare(strict_types=1);

namespace App\Service\Authentication;

use App\Model\Authentication\Token;
use App\Table\Authentication\TokenTable;
use Ramsey\Uuid\Uuid;

class TokenService
{

    public function __construct(
        private readonly TokenTable $tokenTable
    )
    {
    }

    public function create(Token $token): bool
    {
        $token->setToken(Uuid::uuid4()->toString());

        return $this->tokenTable->insert($token);
    }

    public function getByToken(string $tokenString): Token|false
    {
        $tokenData = $this->tokenTable->findByToken($tokenString);
        if($tokenData === FALSE)
        {
            return false;
        }

        $token = new Token();
        $token->setId($tokenData['id']);
        $token->setType($tokenData['type']);
        $token->setAccount($tokenData['account']);
        $token->setToken($tokenString);
        $token->setCreated(new \DateTime($tokenData['created']));
        $token->setExpiry($tokenData['expiry'] !== null ? new \DateTime($tokenData['expiry']) : null);
        $token->setUsed($tokenData['used'] === 1);

        return $token;
    }

    public function setTokenIsUsedUp(int $token): void
    {
        $this->tokenTable->updateUsed($token, true);
    }

}
