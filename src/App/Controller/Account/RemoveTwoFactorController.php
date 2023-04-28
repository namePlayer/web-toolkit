<?php

namespace App\Controller\Account;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Authentication\TwoFactor;
use App\Model\Authentication\TwoFactorType;
use App\Model\Mail\MailType;
use App\Service\Account\SecurityService;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RemoveTwoFactorController
{

    public function __construct(
        private readonly Engine          $template,
        private AccountService           $accountService,
        private readonly SecurityService $securityService,
        private MailerService            $mailerService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);

        $twoFactor = new TwoFactor();
        if(empty($args['id']))
        {
            return new RedirectResponse('/account/security');
        }

        $twoFactor->setId((int)$args['id']);
        $twoFactor->setAccount($account->getId());

        $data = $this->securityService->getTwoFactorByIdAndAccount($twoFactor);
        if($data === FALSE)
        {
            return new RedirectResponse('/account/security');
        }

        $twoFactor->setName($data['name']);
        $twoFactor->setType($data['type']);

        return new HtmlResponse(
            $this->template->render(
                'account/removeTwoFactor',
                [
                    'twoFactorName' => $twoFactor->getName()
                ]
            ));

    }

}