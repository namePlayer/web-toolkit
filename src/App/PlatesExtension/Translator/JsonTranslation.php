<?php

declare(strict_types=1);

namespace App\PlatesExtension\Translator;

class JsonTranslation implements TranslationInterface
{

    private array $translationList;

    public function __construct(private readonly string $translationFile = 'de')
    {
        $this->translationList = json_decode(
            file_get_contents(__DIR__ . '/../../../../translations/' . $this->translationFile . '.json'),
            true
        );
    }

    /**
     * @throws TranslationNotFoundException
     */
    public function getTranslation(string $input): string
    {
        if (isset($this->translationList[$input])) {
            return $this->translationList[$input];
        }
        throw new TranslationNotFoundException($input);
    }

}
