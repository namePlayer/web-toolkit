<?php

namespace App\PlatesExtension\Authentication;

use App\Service\Authentication\AccountService;
use App\Software;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

#[\AllowDynamicProperties]
class AuthenticationExtension implements ExtensionInterface
{

    public function __construct(private readonly AccountService $accountService)
    {
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('getAccountInformation', [$this, 'getAccountInformation']);
    }

    public function getAccountInformation(): false|array
    {
        if(
            isset($_SESSION[Software::SESSION_USERID_NAME]) &&
            !empty($_SESSION[Software::SESSION_USERID_NAME])
        )
        {
            $account = $this->accountService->findAccountById($_SESSION[Software::SESSION_USERID_NAME]);
            if($account !== FALSE)
            {
                return $account;
            }
        }

        return false;
    }

}