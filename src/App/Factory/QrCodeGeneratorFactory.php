<?php declare(strict_types=1);

namespace App\Factory;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

readonly class QrCodeGeneratorFactory
{

    public function createGenerator(bool $usePng = false): Builder
    {

        $builder = Builder::create();
        $builder->writer(new SvgWriter());
        if($usePng)
        {
            $builder->writer(new PngWriter());
        }
        $builder->errorCorrectionLevel(new ErrorCorrectionLevelHigh());
        $builder->encoding(new Encoding('UTF-8'));

        return $builder;

    }

}
