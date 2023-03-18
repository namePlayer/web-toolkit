<?php

namespace App\Service\UrlShortener;

use App\Model\Authentication\Account;
use App\Model\UrlShortener\Shortlink;
use App\Table\UrlShortener\ShortlinkTable;
use App\Validation\UrlShortener\ShortlinkValidation;
use Ramsey\Uuid\Uuid;
use function Sodium\add;

class ShortlinkService
{

    public function __construct(
        private readonly ShortlinkTable $shortlinkTable,
        private readonly ShortlinkValidation $validation,
        private readonly ShortlinkTrackingService $shortlinkTrackingService
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
        $shortlink->setPassword($shortlinkData['password']);
        $shortlink->setTracking($shortlinkData['tracking'] == 1);
        if($shortlinkData['expiryDate'] !== NULL)
        {
            $shortlink->setExpiryDate(new \DateTime($shortlinkData['expiryDate']));
        }

        return;

    }

    public function listShortlinkForUser(Account $account): array
    {

        $shortlinkTable = [];
        foreach ($this->shortlinkTable->findAllByAccountId($account->getId()) as $shortlink)
        {
            $shortlinkTable[] =
                [
                    'id' => $shortlink['id'],
                    'uuid' => $shortlink['uuid'],
                    'domain' => empty($domain) ? $_SERVER['SERVER_NAME'] . '/aka' : $domain,
                    'created' => (new \DateTime($shortlink['created']))->format('d.m.Y H:i'),
                    'account' => $shortlink['account'],
                    'openShortlinkAddress' => empty($domain) ? 'http://' . $_SERVER['SERVER_NAME'] . '/aka' . '/' . $shortlink['uuid'] : 'http://' . $domain . '/' . $shortlink['uuid'],
                    'clicks' => $shortlink['tracking'] === 1 ? $this->shortlinkTrackingService->getClickCountForLink($shortlink['id']) : null
                ];
        }

        return $shortlinkTable;

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