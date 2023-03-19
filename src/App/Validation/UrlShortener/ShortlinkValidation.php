<?php
declare(strict_types=1);

namespace App\Validation\UrlShortener;

use App\Model\UrlShortener\Shortlink;

class ShortlinkValidation
{

    public function validate(Shortlink $shortlink): bool
    {

        if(!filter_var($shortlink->getDestination(), FILTER_VALIDATE_DOMAIN))
        {
            MESSAGES->add('danger', 'shortlink-destination-invalid');
        }

        return MESSAGES->countByType('danger') === 0;

    }

}
