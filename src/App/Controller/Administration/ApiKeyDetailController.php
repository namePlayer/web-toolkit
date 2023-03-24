<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Model\ApiKey\ApiKey;
use App\Model\Authentication\Account;
use App\Service\ApiKey\ApiKeyService;
use App\Service\Authentication\AccountService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiKeyDetailController
{

    public function __construct(
        private readonly Engine $template,
        private readonly ApiKeyService $apiKeyService,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $apiKey = $this->apiKeyService->getApiKeyById((int)$args['id']);
        $owner = new Account();
        if($apiKey === FALSE)
        {
            return new RedirectResponse('/admin/apikeys');
        }
        $owner->setName('System');
        if($apiKey->getAccount() !== NULL)
        {
            $owner->setName($this->accountService->findAccountById($apiKey->getAccount())['name']);
        }

        if($request->getMethod() === "POST")
        {
            $this->manage($request, $apiKey);
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/apiKeyDetail',
                [
                    'apiKey' => $apiKey,
                    'account' => $owner
                ]
            )
        );
    }

    public function manage(ServerRequestInterface $request, ApiKey $apiKey)
    {

        if(isset($_POST['apiKeyLockSwitch']))
        {
            $this->apiKeyService->setActive($apiKey->getId(), (bool)!$apiKey->isActive());
            $apiKey->setActive(!$apiKey->isActive());
            MESSAGES->add('success', 'admin-apikey-management-key-is-active-updated');
        }

        if(isset($_POST['manageApiKeySave'], $_POST['manageApiKeyExpiryField'], $_POST['manageApiKeyPasswordField']))
        {

            $apiKey->setExpires(null);
            if(!empty($_POST['manageApiKeyExpiryField']))
            {
                $apiKey->setExpires(new \DateTime($_POST['manageApiKeyExpiryField']));
            }

            if(empty($_POST['manageApiKeyPasswordField']))
            {
                MESSAGES->add('danger', 'admin-apikey-management-key-is-empty');
                return;
            }

            $this->apiKeyService->updateKey($apiKey);

        }

    }

}
