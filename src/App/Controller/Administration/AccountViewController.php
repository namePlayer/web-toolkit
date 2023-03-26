<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AccountViewController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {

        if(empty($args['id']))
        {
            return new RedirectResponse('/admin/accounts');
        }

        $viewAccount = new Account();
        $viewAccount->setId((int)$args['id']);
        $viewAccountData = $this->accountService->findAccountById($viewAccount->getId());
        if($viewAccountData === FALSE)
        {
            return new RedirectResponse('/admin/accounts');
        }

        $viewAccount->setName($viewAccountData['name']);
        $viewAccount->setEmail($viewAccountData['email']);
        $viewAccount->setRegistered(new \DateTime($viewAccountData['registered']));
        $viewAccount->setActive($viewAccountData['active'] === 1);
        $viewAccount->setLastLogin($viewAccountData['lastLogin'] !== NULL ? new \DateTime($viewAccountData['lastLogin']) : null);
        $viewAccount->setLevel($viewAccountData['level']);
        $viewAccount->setAdmin($viewAccountData['isAdmin'] === 1);

        return new HtmlResponse(
            $this->template->render(
                'administration/accountView', [
                    'account' => $viewAccount,
                    'level' => $this->accountService->getLevelById($viewAccount->getLevel())
                ]
            )
        );
    }

}
