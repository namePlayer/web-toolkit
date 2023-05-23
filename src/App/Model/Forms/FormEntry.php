<?php declare(strict_types=1);

namespace App\Model\Forms;

use DateTime;

class FormEntry
{

    private int $id;
    private int $form;
    private string $uuid;
    private DateTime $entered;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getForm(): int
    {
        return $this->form;
    }

    public function setForm(int $form): void
    {
        $this->form = $form;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getEntered(): DateTime
    {
        return $this->entered;
    }

    public function setEntered(DateTime $entered): void
    {
        $this->entered = $entered;
    }

}
