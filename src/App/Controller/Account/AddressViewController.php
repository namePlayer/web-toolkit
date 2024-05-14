<?php
declare(strict_types=1);

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
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

        return new HtmlResponse($this->template->render('account/addressView', [
            'address' => $address,
        ]));
    }

}
