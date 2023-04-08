<?php

declare(strict_types=1);

namespace App\PlatesExtension\Translator;

use AllowDynamicProperties;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;


#[AllowDynamicProperties]
class TranslationExtension implements ExtensionInterface
{

    public function __construct(private Translation $translation)
    {
    }

    public function register(Engine $engine): void
    {
        $engine->registerFunction('translate', [$this, 'translate']);
    }

    public function translate($var): string
    {
        return $this->translation->getTranslation($var);
    }

}
