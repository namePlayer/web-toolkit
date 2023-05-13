<?php

namespace App\Controller\Account;

use App\DTO\Account\ChangePasswordDTO;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Validation\Authentication\ChangePasswordValidation;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AccountController
{

    public function __construct(
        private Engine         $template,
        private AccountService $accountService,
        private ChangePasswordValidation $changePasswordValidation
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

        if(isset($_POST['accountSettingsChangePasswordSubmit'], $_POST['accountSettingsChangePasswordOldPassword'],
            $_POST['accountSettingsChangePasswordNewPassword'], $_POST['accountSettingsChangePasswordRepeatNewPassword']
        ))
        {
            $changePasswordDTO = new ChangePasswordDTO();
            $changePasswordDTO->setAccount($account->getId());
            $changePasswordDTO->setOldPassword($_POST['accountSettingsChangePasswordOldPassword']);
            $changePasswordDTO->setNewPassword($_POST['accountSettingsChangePasswordNewPassword']);
            $changePasswordDTO->setRepeatNewPassword($_POST['accountSettingsChangePasswordRepeatNewPassword']);

            if(!$this->changePasswordValidation->verify($changePasswordDTO))
            {
                return null;
            }

            if(!$this->accountService->validatePasswordForAccount($changePasswordDTO->getAccount(), $changePasswordDTO->getOldPassword()))
            {
                MESSAGES->add('danger', 'account-settings-change-password-old-password-incorrect');
                return null;
            }

            if($this->accountService->changePasswordForAccount($changePasswordDTO->getAccount(), $changePasswordDTO->getNewPassword()))
            {
                MESSAGES->add('success', 'account-settings-change-password-success');
                return null;
            }

            MESSAGES->add('danger', 'account-settings-change-password-failed');
            return null;
        }

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