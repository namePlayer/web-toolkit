<?php
declare(strict_types=1);

namespace App\Table\Support;

use App\Model\Support\SupportTicket;
use App\Table\AbstractTable;

class SupportTicketTable extends AbstractTable
{

    public function insert(SupportTicket $supportTicket): int|string|bool
    {
        $values = [
            'account' => $supportTicket->getAccount(),
            'title' => $supportTicket->getTitle(),
            'status' => $supportTicket->getStatus()
        ];
        $query = $this->query->insertInto($this->getTableName())->values($values);
        return $query->execute();
    }

    public function updateTicketStatusByTicketId(int $ticketId, int $status): string|int
    {
        $query = $this->query->update($this->getTableName())
            ->where('id', $ticketId)
            ->set('status', $status);

        return $query->execute();
    }

    public function findAllTicketsByAccountId(int $accountId): array|bool
    {
        $query = $this->query->from($this->getTableName())
            ->where('account = ?', [$accountId]);
        return $query->fetchAll();
    }

    public function findAllOpenTickets(int $accountId = null): array
    {
        $query = $this->query->from($this->getTableName());
        if($accountId !== null) {
            $query->where('assignedTechAccount', $accountId);
        }
        $query->select('acCreator.firstname AS ticketCreatorFirstname, acCreator.surname AS ticketCreatorSurname');
        $query->select('acTech.firstname AS techFirstname, acTech.surname AS techSurname');
        $query->where('status = ?', [1]);
        $query->leftJoin('Account acCreator ON acCreator.id = SupportTicket.account');
        $query->leftJoin('Account acTech ON acTech.id = SupportTicket.assignedTechAccount');
        $query->orderBy('updated DESC');

        return $query->fetchAll();
    }

    public function countAllTicketsWithStatus(int $status): string|int
    {
        $query = $this->query->from($this->getTableName())
            ->select(null)
            ->select('COUNT(*)')
            ->where('status', $status);

        return $query->fetchColumn();
    }

    public function countAllTechTicketsWithStatus(int $tech, int $status): string
    {
        $query = $this->query->from($this->getTableName())
            ->select(null)
            ->select('COUNT(*)')
            ->where(['status', 'tech'], [$status, $tech]);

        return $query->fetchColumn();
    }

    public function updateTicketWaitingForCustomerResponse(int $ticket, bool $new): int|string|bool
    {
        $query = $this->query->update($this->getTableName())
            ->set('waitingForCustomerResponse', $new ? 1 : 0)
            ->where('id', $ticket);

        return $query->execute();
    }

    public function updateTicketLastUpdated(int $ticket, \DateTime $lastUpdated): int|string|bool
    {
        $query = $this->query->update($this->getTableName())
            ->set('updated', $lastUpdated->format('Y-m-d H:i:s'))
            ->where('id', $ticket);
        return $query->execute();
    }

    public function updateTicketDetails(SupportTicket $supportTicket): int|string|bool
    {
        $update = [
            'status' => $supportTicket->getStatus() ? 1 : 0,
            'assignedTechAccount' => $supportTicket->getAssignedTechAccount(),
            'onHold' => $supportTicket->isOnHold() ? 1 : 0
        ];

        $query = $this->query->update($this->getTableName())
            ->where('id', $supportTicket->getId())
            ->set($update);

        return $query->execute();
    }

}
