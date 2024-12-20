<?php
declare(strict_types=1);

namespace App\Factory;

use PHPMailer\PHPMailer\PHPMailer;

readonly class MailerFactory
{

    public function __construct(
        private PHPMailer $mailer
    )
    {
    }

    public function getMailer(): PHPMailer
    {
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = $_ENV['MAILER_AUTH'] ?? 'true' == 'true';
        $this->mailer->Host = $_ENV['MAILER_HOST'];
        $this->mailer->Username = $_ENV['MAILER_USERNAME'];
        $this->mailer->Password = $_ENV['MAILER_PASSWORD'];
        $this->mailer->Port = $_ENV['MAILER_PORT'];
        $this->mailer->setFrom($_ENV['MAILER_DISPLAY_EMAIL'], $_ENV['MAILER_DISPLAY_FROM']);
        switch ($_ENV['MAILER_ENCRYPTION'] ?? "none") {
            case "tls":
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                break;
            case "ssl":
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                break;
            case "none":
                $this->mailer->SMTPSecure = false;
                $this->mailer->SMTPAutoTLS = false;
                break;
            default:
                $this->mailer->SMTPSecure = false;
                break;
        }

        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Encoding = 'base64';

        $this->mailer->Timeout = 60;

        return $this->mailer;
    }

}
