<?php
declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\AccountLevel;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RegistrationController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if($request->getMethod() === 'POST')
        {
            $this->register($request);
        }

        return new HtmlResponse($this->template->render('authentication/registration'));
    }

    private function register(ServerRequestInterface $request)
    {

        if(isset($_POST['account-type'], $_POST['account-name'], $_POST['email'], $_POST['password']))
        {

            $account = new Account();
            $account->setName($_POST['account-name']);
            $account->setEmail($_POST['email']);
            $account->setPassword($_POST['password']);
            $account->setLevel(AccountLevel::BASIC_LEVEL);
            if($_POST['account-type'] !== 'private' && $_POST['account-type'] !== 'business')
            {
                return;
            }
            $account->setBusiness($_POST['account-type'] === 'business' ? 0 : null);

            $this->accountService->create($account);

        }

    }

}
