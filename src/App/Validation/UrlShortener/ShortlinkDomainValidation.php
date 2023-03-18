<?php

namespace App\Validation\UrlShortener;

use App\Model\UrlShortener\ShortlinkDomain;

class ShortlinkDomainValidation
{

    public function validate(ShortlinkDomain $shortlinkDomain): bool
    {

        if(empty($shortlinkDomain))
        {
            MESSAGES->add('danger', 'url-shortener-domain-name-empty');
        }

        return MESSAGES->countByType('danger') === 0;
    }

}