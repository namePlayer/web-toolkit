<?php declare(strict_types=1);

namespace App\Service;

use App\Factory\MailerFactory;
use League\Plates\Engine;
use Monolog\Logger;
use PHPMailer\PHPMailer\Exception;

class MailerService
{

    public function __construct(
        private readonly MailerFactory $mailer,
        private readonly Engine $template,
        private readonly Logger $logger
    )
    {
    }

    public function configureMail(string $to, string $subject, string $template, array $content = []): self
    {

        $this->mailer->getMailer()->addAddress($to);

        $this->mailer->getMailer()->isHTML(true);

        $this->mailer->getMailer()->Subject = $subject;
        $this->mailer->getMailer()->Body = $this->template->render('mail/' . $template, $content);

        return $this;

    }

    public function send(): bool
    {

        try {
            $this->mailer->getMailer()->send();
            return true;
        } catch (Exception $exception)
        {
            $this->logger->error($this->mailer->getMailer()->ErrorInfo);
            return false;
        }

    }

}
