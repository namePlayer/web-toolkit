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

}
