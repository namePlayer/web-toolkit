<?php
declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\AccountAddress;
use App\Service\Authentication\AccountAddressService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddressViewController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountAddressService $accountAddressService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        if(empty($args['id']))
        {
            return new RedirectResponse('/account/address');
        }

        $address = $this->accountAddressService->findAddressByIdAndAccount((int)$args['id'], $account->getId());
        if($address === null)
        {
            return new RedirectResponse('/account/address');
        }

        if($request->getMethod() === 'POST')
        {
            $this->process($address);
            $address = $this->accountAddressService->findAddressByIdAndAccount((int)$args['id'], $account->getId());
        }

        return new HtmlResponse($this->template->render('account/addressView', [
            'address' => $address,
        ]));
    }

    public function process(AccountAddress $address): void
    {

        if(isset($_POST['editAddress'])) {
            $address->setCompany(trim($_POST['editAddressCompany']) ?? '');
            $address->setFirstname(trim($_POST['editAddressFirstname']) ?? '');
            $address->setLastname(trim($_POST['editAddressLastname']) ?? '');
            $address->setStreet(trim($_POST['editAddressStreet']) ?? '');
            $address->setHouseNumber(trim($_POST['editAddressHouseNumber']) ?? '');
            $address->setZipCode(trim($_POST['editAddressZipCode']) ?? '');
            $address->setCity(trim($_POST['editAddressCity']) ?? '');
            $address->setCountry(trim($_POST['editAddressCountry']) ?? '');
            $address->setPhone(trim($_POST['editAddressPhone']) ?? '');

            if($this->accountAddressService->update($address))
            {
                MESSAGES->add('success', 'account-address-page-update-success');
                return;
            }

            MESSAGES->add('danger', 'account-address-page-update-failed');
            return;
        }

    }

}
