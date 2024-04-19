<?php

namespace App\Table\Support;

use App\Model\Support\SupportTicketMessage;
use App\Table\AbstractTable;

class SupportTicketMessageTable extends AbstractTable
{

    public function insert(SupportTicketMessage $supportTicketMessage): int|string|bool
    {
        $values = [
            'account' => $supportTicketMessage->getAccount(),
            'ticket' => $supportTicketMessage->getTicket(),
            'message' => $supportTicketMessage->getMessage()
        ];
        $query = $this->query->insertInto($this->getTableName())->values($values);
        return $query->execute();
    }

    public function findAllByTicketId(int $ticketId): array|bool
    {
        $query = $this->query->from($this->getTableName())
            ->select('Account.firstname AS accountFirstname, Account.surname AS accountSurname')
            ->leftJoin('Account on Account.id = '.$this->getTableName().'.account')
            ->where('ticket = ?', [$ticketId])
            ->orderBy('created DESC');
        return $query->fetchAll();
    }

}
