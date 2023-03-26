<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Service\Authentication\AccountService;
use App\Table\Authentication\AccountLevelTable;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AccountViewController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService,
        private readonly AccountLevelTable $accountLevelTable
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
        $viewAccount->setFirstname($viewAccountData['firstname']);
        $viewAccount->setSurname($viewAccountData['surname']);
        $viewAccount->setEmail($viewAccountData['email']);
        $viewAccount->setRegistered(new \DateTime($viewAccountData['registered']));
        $viewAccount->setActive($viewAccountData['active'] === 1);
        $viewAccount->setLastLogin($viewAccountData['lastLogin'] !== NULL ? new \DateTime($viewAccountData['lastLogin']) : null);
        $viewAccount->setLevel($viewAccountData['level']);
        $viewAccount->setSupport($viewAccountData['isSupport'] === 1);
        $viewAccount->setAdmin($viewAccountData['isAdmin'] === 1);

        if($request->getMethod() === 'POST')
        {
            $this->manage($request, $viewAccount);
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/accountView', [
                    'account' => $viewAccount,
                    'levels' => $this->accountLevelTable->findAll(),
                    'level' => $this->accountService->getLevelById($viewAccount->getLevel())
                ]
            )
        );
    }

    public function manage(ServerRequestInterface $request, Account $account)
    {

        if(isset($_POST['adminAccountTabSettingsSaveButton'], $_POST['adminAccountTabSettingsFirstname'], $_POST['adminAccountTabSettingsSurname']) &&
            !empty($_POST['adminAccountTabSettingsAccountName'])&&
            !empty($_POST['adminAccountTabSettingsEmail']) &&
            !empty($_POST['adminAccountTabSettingsAccountLevel'])
            )
        {

            $account->setFirstname($_POST['adminAccountTabSettingsFirstname']);
            $account->setSurname($_POST['adminAccountTabSettingsSurname']);
            $account->setEmail($_POST['adminAccountTabSettingsEmail']);
            $account->setLevel((int)$_POST['adminAccountTabSettingsAccountLevel']);

        }

    }

}
