<?php

declare(strict_types=1);

namespace App\PlatesExtension\Authentication;

use AllowDynamicProperties;
use App\Model\Authentication\AccountLevel;
use App\Service\Authentication\AccountService;
use App\Software;
use App\Table\Authentication\AccountLevelTable;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

#[AllowDynamicProperties]
class AuthenticationExtension implements ExtensionInterface
{

    public function __construct(
        private readonly AccountService    $accountService,
        private readonly AccountLevelTable $levelTable
    )
    {
    }

    public function register(Engine $engine): void
    {
        $engine->registerFunction('getAccountInformation', [$this, 'getAccountInformation']);
        $engine->registerFunction('getLevelBadge', [$this, 'getLevelBadge']);
    }

    public function getAccountInformation(): false|array
    {
        if (
            !empty($_SESSION[Software::SESSION_USERID_NAME])
        ) {
            $account = $this->accountService->findAccountById($_SESSION[Software::SESSION_USERID_NAME]);
            if ($account !== false) {
                return $account;
            }
        }

        return false;
    }

    public function getLevelBadge(): array
    {
        $accountLevel = $this->getAccountInformation()['level'];
        $levelBadge = $this->levelTable->findById($accountLevel);

        return match ($accountLevel) {
            AccountLevel::BASIC_LEVEL => ['label' => $levelBadge['title'], 'color' => 'secondary'],
            AccountLevel::PREMIUM_LEVEL => ['label' => $levelBadge['title'], 'color' => 'warning'],
            AccountLevel::PREMIUM_PLUS_LEVEL => ['label' => $levelBadge['title'], 'color' => 'success'],
            AccountLevel::ENTERPRISE_LEVEL => ['label' => $levelBadge['title'], 'color' => 'info'],
        };
    }

}
