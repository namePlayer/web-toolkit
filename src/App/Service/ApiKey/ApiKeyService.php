<?php declare(strict_types=1);

namespace App\Service\ApiKey;

use App\Model\ApiKey\ApiKey;
use App\Service\Authentication\AccountService;
use App\Table\ApiKey\ApiKeyTable;
use Ramsey\Uuid\Uuid;

class ApiKeyService
{

    public function __construct(
        private readonly ApiKeyTable $apiKeyTable,
        private readonly AccountService $accountService
    )
    {
    }

    public function create(ApiKey $apiKey): ?int
    {

        if(($apiKey->getAccount() !== NULL) &&
            ($this->accountService->findAccountById($apiKey->getAccount()) === FALSE)
        )
        {
            MESSAGES->add('danger', 'admin-apikey-create-user-not-found');
            return null;
        }

        $apiKey->setPassword(Uuid::uuid4()->toString());
        $apiKey->setId((int)$this->apiKeyTable->insert($apiKey));
        return $apiKey->getId();

    }

    public function getAllApiKeys(): array
    {
        return $this->apiKeyTable->getAllApiKeysWithUsername();
    }

    public function getApiKeyById(int $id): ApiKey|false
    {

        $data = $this->apiKeyTable->findById($id);
        if($data === FALSE)
        {
            return false;
        }

        $apiKey = new ApiKey();
        $apiKey->setId($id);
        $apiKey->setAccount($data['account']);
        $apiKey->setPassword($data['password']);
        $apiKey->setCreated(new \DateTime($data['created']));
        $apiKey->setExpires($data['expires'] !== NULL ? new \DateTime($data['expires']) : null);
        $apiKey->setActive($data['active'] === 1);

        return $apiKey;

    }

}
