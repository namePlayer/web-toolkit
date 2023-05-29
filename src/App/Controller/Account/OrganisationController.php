<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OrganisationController
{

    public function __construct(
        private Engine $template,
        private AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if($account->getBusiness() !== null)
        {
            $organisation = $this->accountService->findAccountById($account->getBusiness());
        }

        return new HtmlResponse($this->template->render(
            'account/organisation/organisation',
            [
                'organisation' => $organisation ?? null,
                'account' => $account
            ]
        ));
    }

}
