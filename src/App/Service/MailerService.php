<?php
declare(strict_types=1);

namespace App\Service;

use App\Factory\MailerFactory;
use App\Model\Mail\Mail;
use App\Table\Mail\MailTable;
use League\Plates\Engine;
use Monolog\Logger;
use PHPMailer\PHPMailer\Exception;

class MailerService
{

    private Mail $mail;

    public function __construct(
        private readonly MailerFactory $mailer,
        private readonly MailTable $mailTable,
        private readonly Engine $template,
        private readonly Logger $logger
    ) {
    }

    public function configureMail(string $to, string $subject, int $template, array $content = [], int $account = null): self
    {
        $this->mail = new Mail();
        $this->mail->setEmail($to);
        $this->mail->setAccount($account);
        $this->mail->setType($template);
        $this->mail->setSubject($subject);
        $this->mail->setContent($content);

        return $this;
    }

    public function send(): void
    {
        $this->mailTable->insert($this->mail);
    }

    public function fetchMailsAndSend(): void
    {
        $this->logger->info('Starting Mail Batch');
        $mails = $this->mailTable->findAllNotSentLimit();

        $amount = count($mails);
        $this->logger->info('Collected a batch of ' . $amount . ' Mails.');
        $success = 0;

        foreach ($mails as $mail) {

            $time = microtime(true);
            $this->mailer->getMailer()->isHTML();
            $this->mailer->getMailer()->Subject = $mail['subject'];
            $this->mailer->getMailer()->addAddress($mail['email']);
            $this->mailer->getMailer()->Body =
            $this->template->render('mail/'.$mail['template'], json_decode($mail['content'], true));

            try {
                $this->mailer->getMailer()->send();
                $this->mailTable->updateMailSentById($mail['id']);
                $success++;
                $this->logger->info('Mail Sending took ' . microtime(true) - $time . 'ms ('.$success.'/'.$amount.')');
            } catch (Exception)
            {
                $this->logger->error('Mail Sending failed after ' . microtime() - $time . 'ms', [$this->mailer->getMailer()->ErrorInfo]);
            }

        }

        $this->logger->info('Mail Batch complete. Sent a total of ' . $success . ' E-Mails');

    }

}
