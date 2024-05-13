<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\DTO\Account\ChangePasswordDTO;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Validation\Authentication\ChangePasswordValidation;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AddressController
{

    public function __construct(
        private Engine                   $template,
        private AccountService           $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        $accountData = $this->accountService->findAccountById($account->getId());

        return new HtmlResponse($this->template->render(
            'account/address'
        ));
    }

}
