<?php

namespace App\Validation\UrlShortener;

use App\Model\UrlShortener\Shortlink;

class ShortlinkValidation
{

    public function validate(Shortlink $shortlink): bool
    {

        if(!filter_var($shortlink->getDestination(), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
        {
            MESSAGES->add('danger', 'shortlink-destination-invalid');
        }

        return MESSAGES->countByType('danger') === 0;

    }

}