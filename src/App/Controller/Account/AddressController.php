<?php declare(strict_types=1);

namespace App\Controller\Account;

use App\DTO\Account\ChangePasswordDTO;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\AccountAddress;
use App\Service\Authentication\AccountAddressService;
use App\Service\Authentication\AccountService;
use App\Validation\Authentication\ChangePasswordValidation;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class AddressController
{

    public function __construct(
        private Engine                   $template,
        private AccountService           $accountService,
        private AccountAddressService    $accountAddressService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);


        if($request->getMethod() === 'POST')
        {
            $postResult = $this->process($account);
            if($postResult > 0)
            {
                return new RedirectResponse('/account/address/'.$postResult);
            }
        }

        return new HtmlResponse($this->template->render(
            'account/address',
            [
                'addresses' => $this->accountAddressService->findAllAddressesByAccountId($account->getId())
            ]
        ));
    }

    public function process(Account $account): int
    {
        if(isset($_POST['addNewAddressSubmit']))
        {

            $accountAddress = new AccountAddress();
            $accountAddress->setAccount($account->getId());
            $accountAddress->setCompany(trim($_POST['addNewAddressCompany']) ?? '');
            $accountAddress->setFirstname(trim($_POST['addNewAddressFirstname']) ?? '');
            $accountAddress->setLastname(trim($_POST['addNewAddressLastname']) ?? '');
            $accountAddress->setStreet(trim($_POST['addNewAddressStreet']) ?? '');
            $accountAddress->setHouseNumber(trim($_POST['addNewAddressHouseNumber']) ?? '');
            $accountAddress->setZipCode(trim($_POST['addNewAddressZipCode']) ?? '');
            $accountAddress->setCity(trim($_POST['addNewAddressCity']) ?? '');
            $accountAddress->setCountry(trim($_POST['addNewAddressCountry']) ?? '');
            $accountAddress->setPhone(trim($_POST['addNewAddressPhone']) ?? '');

            if(!$this->accountAddressService->create($accountAddress))
            {
                MESSAGES->add('danger', 'account-address-page-failed-adding');
            }

            return $accountAddress->getId();
        }

        return 0;
    }

}
