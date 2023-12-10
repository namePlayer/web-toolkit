<?php declare(strict_types=1);

namespace App\Service\QrCodeGenerator;

use App\Factory\QrCodeGeneratorFactory;

readonly class QrCodeGeneratorService
{

    public function __construct(
        private QrCodeGeneratorFactory $codeGeneratorFactory
    )
    {
    }

    public function createBase64QrCodeFromString(string $data): string
    {

        $builder = $this->codeGeneratorFactory->createGenerator(true);
        $result = $builder->data($data)
            ->size(550)
            ->margin(0)
            ->build();

        return $result->getDataUri();
    }

}
