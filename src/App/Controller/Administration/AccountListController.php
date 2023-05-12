<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\DTO\Account\AccountSearchDTO;
use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AccountListController
{

    public function __construct(
        private Engine         $template,
        private AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render(
                'administration/accountList',
                ['accounts' => $this->search()]
            )
        );
    }

    private function search(): array
    {
        $accountSearchDTO = new AccountSearchDTO();

        if(!empty($_POST['adminSearchAccountModalID']))
        {
            $accountSearchDTO->setId((int)$_POST['adminSearchAccountModalID']);
        }

        if(!empty($_POST['adminSearchAccountModalName']))
        {
            $accountSearchDTO->setName($_POST['adminSearchAccountModalName']);
        }

        if(!empty($_POST['adminSearchAccountModalEmail']))
        {
            $accountSearchDTO->setEmail($_POST['adminSearchAccountModalEmail']);
        }

        if(!empty($_POST['adminSearchAccountModalFirstname']))
        {
            $accountSearchDTO->setFirstname($_POST['adminSearchAccountModalFirstname']);
        }

        if(!empty($_POST['adminSearchAccountModalSurname']))
        {
            $accountSearchDTO->setSurname($_POST['adminSearchAccountModalSurname']);
        }

        return $this->accountService->getAccountList($accountSearchDTO);
    }

}
