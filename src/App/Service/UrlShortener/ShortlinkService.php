<?php

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\Shortlink;
use App\Table\UrlShortener\ShortlinkTable;
use App\Validation\UrlShortener\ShortlinkValidation;
use Ramsey\Uuid\Uuid;

class ShortlinkService
{

    public function __construct(
        private readonly ShortlinkTable $shortlinkTable,
        private readonly ShortlinkValidation $validation
    )
    {
    }

    public function create(Shortlink $shortlink): ?string
    {

        if(
            !str_starts_with($shortlink->getDestination(), 'http://') &&
            !str_starts_with($shortlink->getDestination(), 'https://')
        ) {
            $shortlink->setDestination('http://' . $shortlink->getDestination());
        }

        if($this->validation->validate($shortlink) === FALSE)
        {
            return null;
        }

        $shortlink->setUuid($this->generateShortLink());

        $this->shortlinkTable->insert($shortlink);

        return 'https://web-toolkit.ddev.site/aka/' . $shortlink->getUuid();

    }

    public function openShortlink(Shortlink $shortlink): void
    {

        $shortlinkData = $this->shortlinkTable->findByUUID($shortlink->getUuid());
        if($shortlinkData === FALSE)
        {
            $shortlink->setDestination('');
            return;
        }

        $shortlink->setDestination($shortlinkData['destination']);
        return;

    }

    private function generateShortLink(): string
    {
        $link = Uuid::uuid4();

        return substr($link, 0, strpos($link, "-"));
    }

}