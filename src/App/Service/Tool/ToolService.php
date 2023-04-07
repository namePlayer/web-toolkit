<?php
declare(strict_types=1);

namespace App\Service\Tool;

use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Table\Tool\ToolTable;
use Monolog\Logger;

readonly class ToolService
{

    public function __construct(
        private ToolTable      $toolTable,
        private AccountService $accountService,
        private Logger         $logger
    )
    {
    }

    public function getAllTools(): array
    {
        return $this->toolTable->getAllTools();
    }

    public function getAllToolsForUser(Account $account): array
    {
        return $this->toolTable->getAllToolsByMaxLevel($account->getLevel());
    }

    public function isToolAvailableForUser(Account $account, int $tool): bool
    {
        $level = $account->getLevel();
        $tool = $this->toolTable->findById($tool);

        if($tool['level'] <= $level)
        {
            return true;
        }

        return false;
    }

}
