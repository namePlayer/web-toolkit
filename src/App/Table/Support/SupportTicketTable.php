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

    public function findAllTicketsByAccountId(int $accountId): array|bool
    {
        $query = $this->query->from($this->getTableName())
            ->where('account = ?', [$accountId]);
        return $query->fetchAll();
    }

}
