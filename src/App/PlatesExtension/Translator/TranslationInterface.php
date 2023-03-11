<?php

namespace App\PlatesExtension\Translator;

interface TranslationInterface
{

    public function getTranslation(string $input): string;

}