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

}
