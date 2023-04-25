<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Security\AccountTrustedDevice;
use App\Service\Authentication\AccountService;
use App\Service\Security\AccountTrustedDeviceService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AllowIpAddressController
{

    public function __construct(
        private Engine $template,
        private AccountService  $accountService,
        private AccountTrustedDeviceService $accountTrustedDeviceService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if(empty($_GET['address']))
        {
            return new RedirectResponse('/account/security');
        }

        $accountTrustedDevice = new AccountTrustedDevice();
        $accountTrustedDevice->setIpAddress($_GET['address']);
        $accountTrustedDevice->setAccount($account->getId());

        if($request->getMethod() === 'POST')
        {
            $res = $this->create($accountTrustedDevice);
            if($res instanceof ResponseInterface)
            {
                return $res;
            }
        }

        return new HtmlResponse(
            $this->template->render('account/allowIpAddress',
                [
                    'ipAddress' => $accountTrustedDevice->getIpAddress()
                ]));
    }

    public function create(AccountTrustedDevice $accountTrustedDevice): ?ResponseInterface
    {

        if($this->accountTrustedDeviceService->add($accountTrustedDevice))
        {
            return new RedirectResponse('/account/security');
        }

        return null;
    }

}
