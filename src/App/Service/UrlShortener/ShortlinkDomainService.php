<?php

declare(strict_types=1);

namespace App\Service\UrlShortener;

use App\DTO\UrlShortener\ShortlinkDomainSearchDTO;
use App\Model\UrlShortener\ShortlinkDomain;
use App\Table\UrlShortener\ShortlinkDomainTable;
use App\Validation\UrlShortener\ShortlinkDomainValidation;
use Ramsey\Uuid\Uuid;

readonly class ShortlinkDomainService
{

    public function __construct(
        private ShortlinkDomainTable      $shortlinkDomainTable,
        private ShortlinkDomainValidation $shortlinkDomainValidation
    )
    {
    }

    public function create(ShortlinkDomain $shortlinkDomain): void
    {
        if ($this->shortlinkDomainValidation->validate($shortlinkDomain) === false) {
            return;
        }

        $shortlinkDomain->setUuid(Uuid::uuid4()->toString());

        if ($this->shortlinkDomainTable->findByAddress($shortlinkDomain->getAddress()) !== false) {
            MESSAGES->add('danger', 'url-shortener-domain-exists-creation');
            return;
        }

        $id = $this->shortlinkDomainTable->insert($shortlinkDomain);

        if ($id === false) {
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

    public function getAllDomains(ShortlinkDomainSearchDTO $domainSearchDTO): array
    {
        $search = [];

        if($domainSearchDTO->getId() !== 0)
        {
            $search = array_merge($search, ['ShortlinkDomain.id' => $domainSearchDTO->getId()]);
        }

        if($domainSearchDTO->getAccount() !== 0)
        {
            $search = array_merge($search, ['ShortlinkDomain.user' => $domainSearchDTO->getAccount()]);
        }

        if($domainSearchDTO->getAddress() !== '')
        {
            $search = array_merge($search, ['ShortlinkDomain.address LIKE ?' => '%'.$domainSearchDTO->getAddress().'%']);
        }

        return $this->shortlinkDomainTable->findBySearchArray($search, $domainSearchDTO->getLimit());
    }

    public function getDomainListForUser(int $user): array
    {
        return $this->shortlinkDomainTable->getAllDomainsForUser($user);
    }

    public function getByUUID(string $uuid): array
    {
        $result = $this->shortlinkDomainTable->findByUUID($uuid);

        return $result === false ? [] : $result;
    }

    public function getById(int $id): array
    {
        $result = $this->shortlinkDomainTable->findById($id);

        return $result === false ? [] : $result;
    }

    public function getByDomain(string $domain): array|false
    {
        return $this->shortlinkDomainTable->findByAddress($domain);
    }

    public function getAllByLimitDescending(int $limit): array|false
    {
        return $this->shortlinkDomainTable->findAllWithLimitDescending($limit);
    }

    public function getDomainNameByID(?int $id): ?string
    {
        $domain = $this->getById($id);
        return $domain['address'];
    }

    public function changeVerificationState(int $domain, bool $active): bool
    {
        return $this->shortlinkDomainTable->updateActivationForDomainID($domain, $active) > 0;
    }

    public function changeDisabledState(int $domain, bool $disabled): bool
    {
        return $this->shortlinkDomainTable->updateDisabledForDomainID($domain, $disabled) > 0;
    }

    public function getCount(): int
    {
        return (int)$this->shortlinkDomainTable->countAll();
    }

}
