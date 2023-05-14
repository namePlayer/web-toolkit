<?php

namespace App\Model\Forms;

use DateTime;

class FormEntry
{

    private int $id;
    private DateTime $entered;
    private array $fields = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEntered(): DateTime
    {
        return $this->entered;
    }

    public function setEntered(DateTime $entered): void
    {
        $this->entered = $entered;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

}
