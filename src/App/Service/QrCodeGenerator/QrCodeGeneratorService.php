<?php declare(strict_types=1);

namespace App\Service\QrCodeGenerator;

use App\Factory\QrCodeGeneratorFactory;

class QrCodeGeneratorService
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
            ->size(300)
            ->margin(10)
            ->build();

        return $result->getDataUri();
    }

}
