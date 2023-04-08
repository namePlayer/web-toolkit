<?php

declare(strict_types=1);

namespace App\PlatesExtension\Translator;

interface TranslationInterface
{

    public function getTranslation(string $input): string;

}
