<?php

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AccountController
{

    public function __construct(
        private Engine         $template,
        private AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        $accountData = $this->accountService->findAccountById($account->getId());

        if($request->getMethod() === "POST")
        {
            $update = $this->update($account);
            if(is_array($update))
            {
                $accountData = $update;
            }
        }

        return new HtmlResponse($this->template->render(
            'account/account',
            [
                'accountData' => $accountData
            ]
        ));
    }

    public function update(Account $account): ?array
    {

        $updateAccount = clone $account;

        $updateAccount->setName($_POST['accountUserAccountname']);
        $updateAccount->setFirstname($_POST['accountUserFirstname']);
        $updateAccount->setSurname($_POST['accountUserLastname']);
        $updateAccount->setEmail($_POST['accountUserEmail']);

        if($this->accountService->updateAccount($updateAccount))
        {
            return $this->accountService->findAccountById($account->getId());
        }
        
        return null;
    }

}