<?php declare(strict_types=1);

namespace App\Factory;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;

readonly class QrCodeGeneratorFactory
{

    public function createGenerator(): Builder
    {

        $builder = Builder::create();
        $builder->writer(new SvgWriter());
        $builder->errorCorrectionLevel(new ErrorCorrectionLevelHigh());

        return $builder;

    }

}
