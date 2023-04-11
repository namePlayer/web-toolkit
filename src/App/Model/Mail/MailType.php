<?php declare(strict_types=1);

namespace App\Model\Mail;

class MailType
{

    public const ACTIVATION_MAIL_ID = 1;
    public const RESET_PASSWORD_MAIL_ID = 2;

    private int $id;
    private string $title;
    private string $template;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

}
