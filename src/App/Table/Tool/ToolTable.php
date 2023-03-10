<?php

namespace App\Table\Tool;

use App\Model\Authentication\Account;
use App\Table\AbstractTable;

class ToolTable extends AbstractTable
{

    public function getAllTools(): array
    {
        return $this->query->from($this->getTableName())->fetchAll();
    }

    public function getAllToolsByMaxLevel(int $level): array
    {

        return $this->query->from($this->getTableName())
            ->where('level <= ?', $level)
            ->where('active', 1)
            ->fetchAll();
    }

    public function findByPath(string $path): array|false
    {
        return $this->query->from($this->getTableName())->where('path', $path)->fetch();
    }

}