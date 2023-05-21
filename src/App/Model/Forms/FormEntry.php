<?php

namespace App\Model\Forms;

use DateTime;

class FormEntry
{

    private int $id;
    private string $uuid;
    private int $form;
    private int $field;
    private string $value;
    private DateTime $entered;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getForm(): int
    {
        return $this->form;
    }

    public function setForm(int $form): void
    {
        $this->form = $form;
    }

    public function getField(): int
    {
        return $this->field;
    }

    public function setField(int $field): void
    {
        $this->field = $field;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
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
