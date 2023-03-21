<?php declare(strict_types=1);

namespace App\Service\ApiKey;

use App\Model\ApiKey\ApiKey;
use App\Table\ApiKey\ApiKeyTable;

class ApiKeyService
{

    public function __construct(
        private readonly ApiKeyTable $apiKeyTable
    )
    {
    }

    public function getAllApiKeys(): array
    {
        return $this->apiKeyTable->getAllApiKeysWithUsername();
    }

}
