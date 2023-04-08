<?php
declare(strict_types=1);

namespace App\Service\UrlShortener;

use App\Model\Authentication\Account;
use App\Model\UrlShortener\Shortlink;
use App\Table\UrlShortener\ShortlinkTable;
use App\Tool\ShortlinkTool;
use App\Validation\UrlShortener\ShortlinkValidation;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;

readonly class ShortlinkService
{

    public function __construct(
        private ShortlinkTable           $shortlinkTable,
        private ShortlinkValidation      $validation,
        private ShortlinkTrackingService $shortlinkTrackingService,
        private ShortlinkDomainService   $shortlinkDomainService
    )
    {
    }

    public function create(Shortlink $shortlink): ?string
    {
        if($this->validation->validate($shortlink) !== FALSE) {
            $this->correctDestinationLinkFormat($shortlink);

            if (!empty($shortlink->getUuid()) && $this->shortlinkExists($shortlink)) {
                MESSAGES->add('danger', 'shortlink-already-exists');
                return null;
            }

            if (empty($shortlink->getUuid()))
                $this->generateShortLink($shortlink);

            $this->shortlinkTable->insert($shortlink);

            return $shortlink->getUuid();
        }

        return null;
    }

    /**
     * @throws Exception
     */
    public function openShortlink(Shortlink $shortlink): void
    {

        $shortlinkData = $this->shortlinkTable->findByUUIDAndDomain($shortlink);
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
            $shortlink->setExpiryDate(new DateTime($shortlinkData['expiryDate']));
        }

    }

    /**
     * @throws Exception
     */
    public function listShortlinkForUser(Account $account): array
    {

        $shortlinkTable = [];
        foreach ($this->shortlinkTable->findAllByAccountId($account->getId()) as $shortlink)
        {
            $shortlinkTable[] =
                [
                    'id' => $shortlink['id'],
                    'uuid' => $shortlink['uuid'],
                    'domain' => empty($shortlink['domain']) ? ShortlinkTool::getDefaultUrl() : $this->shortlinkDomainService->getDomainNameByID($shortlink['domain']),
                    'created' => (new DateTime($shortlink['created']))->format('d.m.Y H:i'),
                    'account' => $shortlink['account'],
                    'openShortlinkAddress' => empty($domain) ? \App\Tool\ShortlinkTool::getDefaultUrl() . $shortlink['uuid'] : 'http://' . $domain . '/' . $shortlink['uuid'],
                    'clicks' => $shortlink['tracking'] === 1 ? $this->shortlinkTrackingService->getClickCountForLink($shortlink['id']) : null
                ];
        }

        return $shortlinkTable;

    }

    /**
     * @throws Exception
     */
    public function getShortlinkById(int $id): ?Shortlink
    {
        $shortlinkData = $this->shortlinkTable->findById($id);
        if($shortlinkData === FALSE)
        {
            return null;
        }

        $shortlink = new Shortlink();
        $shortlink->setId($id);
        $shortlink->setDomain($shortlinkData['domain']);
        $shortlink->setUuid($shortlinkData['uuid']);
        $shortlink->setAccount($shortlinkData['account']);
        $shortlink->setDateTime(new DateTime($shortlinkData['created']));
        $shortlink->setDestination($shortlinkData['destination']);
        $shortlink->setExpiryDate($shortlinkData['expiryDate'] !== NULL ? new DateTime($shortlinkData['expiryDate']) : null);
        $shortlink->setPassword($shortlinkData['password']);
        $shortlink->setTracking($shortlinkData['tracking'] === 1);

        return $shortlink;
    }

    public function getAllShortlinksByLimit(int $limit): array
    {
        return $this->shortlinkTable->findALlLimitResults($limit);
    }

    public function getShortlinkCount(): int
    {
        return (int)$this->shortlinkTable->countAll();
    }

    public function getShortlinkCountForLastDays(int $days): int
    {
        return (int)$this->shortlinkTable->countAllInLastDays($days);
    }

    private function generateShortLink(Shortlink $shortlink): void
    {
        do {
            $shortlink->setUuid(Uuid::uuid4()->toString());
            $shortlink->setUuid(substr($shortlink->getUuid(), 0, strpos($shortlink->getUuid(), "-")));
        } while($this->shortlinkExists($shortlink));

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
