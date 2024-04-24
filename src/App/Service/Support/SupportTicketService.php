<?php
declare(strict_types=1);

namespace App\Service\Support;

use App\Model\Support\SupportTicket;
use App\Model\Support\SupportTicketMessage;
use App\Table\Support\SupportTicketMessageTable;
use App\Table\Support\SupportTicketTable;

class SupportTicketService
{

    public function __construct(
        private readonly SupportTicketTable $supportTicketTable,
        private readonly SupportTicketMessageTable $supportTicketMessageTable
    )
    {
    }

    public function createSupportTicket(SupportTicket $supportTicket, SupportTicketMessage $supportTicketMessage): int
    {
        $supportTicket->setStatus(0);
        $supportTicketId = $this->supportTicketTable->insert($supportTicket);
        if(is_numeric($supportTicketId)){
            $supportTicket->setId((int)$supportTicketId);
            $supportTicketMessage->setTicket($supportTicket->getId());
            $this->createTicketMessageReply($supportTicketMessage);
            return 0;
        }

        return 255;
    }

    public function createTicketMessageReply(SupportTicketMessage $supportTicketMessage): bool
    {
        return is_numeric($this->supportTicketMessageTable->insert($supportTicketMessage));
    }

    public function updateTicketStatus(int $ticketId, int $status): bool
    {
        return (int)$this->supportTicketTable->updateTicketStatusByTicketId($ticketId, $status) > 0;
    }

    public function countAllOpenTickets(): int
    {
        $open = (int)$this->supportTicketTable->countAllTicketsWithStatus(0);
        $onHold = (int)$this->supportTicketTable->countAllTicketsWithStatus(1);
        return $open+$onHold;
    }

    public function getAllOpenTickets(int $user = null): array
    {
        return $this->supportTicketTable->findAllOpenTickets($user);
    }

    public function getAllTicketsForUser(int $userId): array
    {
        $ticketList = $this->supportTicketTable->findAllTicketsByAccountId($userId);
        if(is_array($ticketList)){
            return $ticketList;
        }

        return [];
    }

    public function getTicketById(int $ticketId): ?array
    {
        $ticket = $this->supportTicketTable->findById($ticketId);
        return is_array($ticket) ? $ticket : null;
    }

    public function getAllTicketMessagesByTicketId(int $ticketId): array
    {
        return $this->supportTicketMessageTable->findAllByTicketId($ticketId);
    }

}
