<?php

declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use App\Service\MailerService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class MailController
{

    public function __construct(
        private Engine $template,
        private MailerService $mailerService
    ) {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        if($request->getMethod() === 'POST')
        {
            $this->send();
        }

        return new HtmlResponse(
            $this->template->render(
                'administration/mail',
                [
                    'unsentMailAmount' => $this->mailerService->getUnsentAmount(),
                    'mailsLastSevenDaysAmount' => $this->mailerService->getSentAmountForLastXDays(7)
                ]
            )
        );
    }

    public function send(): void
    {

        if(isset($_POST['emailDashboardSendEmailModalSendButton'], $_POST['emailDashboardSendEmailModalAmount']))
        {

            $amount = (int)$_POST['emailDashboardSendEmailModalAmount'];
            if($amount === 0)
            {
                $amount = $this->mailerService->getUnsentAmount();
            }

            $this->mailerService->fetchMailsAndSend($amount);

            if($this->mailerService->getSentSuccessfullyAmount() > 0)
            {
                MESSAGES->add('success', 'administration-mail-dashboard-send-unsent-mails-amount-success',
                    (string)$this->mailerService->getSentSuccessfullyAmount()
                );
                return;
            }

            MESSAGES->add('danger', 'administration-mail-dashboard-send-unsent-mails-no-mails-found');

        }

    }

}
