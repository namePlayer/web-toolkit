<?php

declare(strict_types=1);

namespace App\PlatesExtension\Translator;

use Monolog\Logger;

class Translation
{

    public function __construct(private readonly TranslationInterface $translation, private readonly Logger $logger)
    {
    }

    public function getTranslation(string $value): string
    {
        try {
            return $this->translation->getTranslation($value);
        } catch (TranslationNotFoundException $exception) {
            $this->logger->error('Translation ' . $exception->getMessage() . ' could not be loaded.');
            return $exception->getMessage();
        }
    }

}
