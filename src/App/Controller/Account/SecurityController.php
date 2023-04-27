<?php

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\Security\AccountTrustedDeviceService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SecurityController
{

    public function __construct(
        private readonly Engine             $template,
        private AccountService              $accountService,
        private SecurityService             $securityService,
        private AccountTrustedDeviceService $accountTrustedDeviceService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if ($request->getMethod() === 'POST') {
            $this->create($account);
        }

        return new HtmlResponse(
            $this->template->render('account/security',
                [
                    'account' => $this->accountService->findAccountById($account->getId()),
                    'twoFactors' => $this->securityService->getTwoFactorByAccountID($account->getId()),
                    'allowedAddresses' => $this->accountTrustedDeviceService->getTrustedIpsForAccount($account->getId())
                ]));
    }

    public function create(Account $account): void
    {

        if (isset($_POST['securityBasicSettingsSave'])) {

            $this->accountService->setSendLoginEmail($account->getId(), isset($_POST['sendLoginEmailCheck']));

            MESSAGES->add('success', 'account-settings-security-update-success');

        }

    }

}