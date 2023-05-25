<?php

namespace App\Model\Forms;

class FormEntryField
{

    private int $id;
    private int $entry;
    private int $field;
    private string $value;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEntry(): int
    {
        return $this->entry;
    }

    public function setEntry(int $entry): void
    {
        $this->entry = $entry;
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

}
