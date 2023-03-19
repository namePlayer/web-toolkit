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

    public function create(ShortlinkDomain $shortlinkDomain)
    {

        if($this->shortlinkDomainValidation->validate($shortlinkDomain) === FALSE)
        {
            return;
        }

        $shortlinkDomain->setUuid(Uuid::uuid4());

        $id = $this->shortlinkDomainTable->insert($shortlinkDomain);

        if($id === FALSE)
        {
            MESSAGES->add('danger', 'url-shortener-domain-failed-creation');
            return;
        }

        MESSAGES->add('success', 'url-shortener-domain-created');

    }

}
