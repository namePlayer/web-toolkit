<?php

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\Shortlink;
use App\Table\UrlShortener\ShortlinkTable;
use App\Validation\UrlShortener\ShortlinkValidation;
use Ramsey\Uuid\Uuid;
use function Sodium\add;

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
        if($this->validation->validate($shortlink) === FALSE)
        {
            return null;
        }

        $this->correctDestinationLinkFormat($shortlink);

        if(!empty($shortlink->getUuid()) && $this->shortlinkExists($shortlink))
        {
            MESSAGES->add('danger', 'shortlink-already-exists');
            return null;
        }

        if(empty($shortlink->getUuid()))
        {
            $shortlink->setUuid($this->generateShortLink());
            do {
                $shortlink->setUuid($this->generateShortLink());
            } while($this->shortlinkExists($shortlink));
        }

        $this->shortlinkTable->insert($shortlink);

        return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/aka/' . $shortlink->getUuid();

    }

    public function openShortlink(Shortlink $shortlink): void
    {

        $shortlinkData = $this->shortlinkTable->findByUUID($shortlink->getUuid());
        if($shortlinkData === FALSE)
        {
            $shortlink->setDestination('');
            return;
        }

        $shortlink->setId($shortlinkData['id']);
        $shortlink->setDestination($shortlinkData['destination']);
        if($shortlinkData['expiryDate'] !== NULL)
        {
            $shortlink->setExpiryDate(new \DateTime($shortlinkData['expiryDate']));
        }

        return;

    }

    private function generateShortLink(): string
    {
        $link = Uuid::uuid4();

        return substr($link, 0, strpos($link, "-"));
    }

    private function shortlinkExists(Shortlink $shortlink): bool
    {
        return $this->shortlinkTable->findByUUIDAndDomain($shortlink) !== FALSE;
    }

    private function correctDestinationLinkFormat(Shortlink $shortlink): void
    {

        if(
            !str_starts_with($shortlink->getDestination(), 'http://') &&
            !str_starts_with($shortlink->getDestination(), 'https://')
        ) {
            $shortlink->setDestination('http://' . $shortlink->getDestination());
        }
    }

}