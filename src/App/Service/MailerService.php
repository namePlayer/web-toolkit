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
    private int $successSent = 0;

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

    public function fetchMailsAndSend(int $amount = null): void
    {
        $limit = $_ENV['MAILER_MAX_BATCH_SIZE'];
        if($amount !== NULL)
        {
            $limit = $amount;
        }

        $this->logger->info('Starting Mail Batch');
        $mails = $this->mailTable->findAllNotSentLimit($limit);

        $amount = count($mails);
        $this->logger->info('Collected a batch of ' . $amount . ' Mails.');

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
                $this->successSent++;
                $this->logger->info('Mail Sending took ' . microtime(true) - $time . 'ms ('.$this->successSent.'/'.$amount.')');
            } catch (Exception)
            {
                $this->mailTable->updateMailSentById($mail['id']);
                $this->logger->error('Mail Sending failed after ' . microtime(true) - $time . 'ms', [$this->mailer->getMailer()->ErrorInfo]);
            }

        }

        $this->logger->info('Mail Batch complete. Sent a total of ' . $this->successSent . ' E-Mails');

    }

    public function getSentSuccessfullyAmount(): int
    {
        return $this->successSent;
    }

    public function getUnsentAmount(): int
    {
        return (int)$this->mailTable->findAmountBySentNull();
    }

    public function getSentAmountForLastXDays(int $days): int
    {
        return (int)$this->mailTable->findAmountByLastDays($days);
    }

}
