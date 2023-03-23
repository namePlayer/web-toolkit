<?php
declare(strict_types=1);

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\ShortlinkDomain;
use App\Table\UrlShortener\ShortlinkDomainTable;
use App\Validation\UrlShortener\ShortlinkDomainValidation;
use Ramsey\Uuid\Uuid;

class ShortlinkDomainService
{

    public function __construct(
        private readonly ShortlinkDomainTable $shortlinkDomainTable,
        private readonly ShortlinkDomainValidation $shortlinkDomainValidation
    )
    {
    }

    public function create(ShortlinkDomain $shortlinkDomain): void
    {

        if($this->shortlinkDomainValidation->validate($shortlinkDomain) === FALSE)
        {
            return;
        }

        $shortlinkDomain->setUuid(Uuid::uuid4()->toString());

        if($this->shortlinkDomainTable->findByAddress($shortlinkDomain->getAddress()) !== FALSE)
        {
            MESSAGES->add('danger', 'url-shortener-domain-exists-creation');
            return;
        }

        $id = $this->shortlinkDomainTable->insert($shortlinkDomain);

        if($id === FALSE)
        {
            MESSAGES->add('danger', 'url-shortener-domain-failed-creation');
            return;
        }

        MESSAGES->add('success', 'url-shortener-domain-created');

    }

    public function accountIsAllowedToUseDomain(int $account, int $domain): bool
    {
        $result = $this->shortlinkDomainTable->findById($domain);

        return $result['user'] === $account;
    }

    public function getDomainListForUser(int $user): array
    {

        return $this->shortlinkDomainTable->getAllDomainsForUser($user);

    }

    public function getByUUID(string $uuid): array
    {
        $result = $this->shortlinkDomainTable->findByUUID($uuid);

        return $result === FALSE ? [] : $result;
    }

    public function getById(int $id): array
    {

        $result = $this->shortlinkDomainTable->findById($id);

        return $result === FALSE ? [] : $result;

    }

    public function getByDomain(string $domain): array|false
    {

        return $this->shortlinkDomainTable->findByAddress($domain);

    }

}
