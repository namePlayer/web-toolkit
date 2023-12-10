<?php

namespace App\DTO\QrCodeGenerator;

class TextQrCodeDTO
{

    private string $text;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

}
