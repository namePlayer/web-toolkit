<?php

namespace App\Model\Forms;

class FormFieldType
{

    public const HEADER_FIELD = 1;
    public const TEXT_FIELD = 2;
    public const TEXTAREA_FIELD = 3;
    public const DROPDOWN_FIELD = 4;

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
