<?php

namespace App\Model\Authentication;

class TokenType
{

    public const ACTIVATION_TOKEN = 1;
    public const RESET_PASSWORD_TOKEN = 2;

    private int $id;
    private int $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): int
    {
        return $this->title;
    }

    public function setTitle(int $title): void
    {
        $this->title = $title;
    }

}
