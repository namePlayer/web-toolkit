<?php declare(strict_types=1);

namespace App\Factory;

use PHPMailer\PHPMailer\PHPMailer;

class MailerFactory
{

    public function __construct(
        private readonly PHPMailer $mailer
    )
    {
    }

    public function getMailer(): PHPMailer
    {

        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = $_ENV['MAILER_HOST'];
        $this->mailer->Username = $_ENV['MAILER_USERNAME'];
        $this->mailer->Password = $_ENV['MAILER_PASSWORD'];
        $this->mailer->Port = $_ENV['MAILER_PORT'];
        $this->mailer->setFrom($_ENV['MAILER_DISPLAY_EMAIL'], $_ENV['MAILER_DISPLAY_FROM']);

        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Encoding = 'base64';

        return $this->mailer;

    }

}
