<?php declare(strict_types=1);

namespace App\Controller\QrCode;

use App\Factory\QrCodeGeneratorFactory;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class GenerateController
{

    public function __construct(
        private QrCodeGeneratorFactory $qrGenerator,
        private Engine $template
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        /* @var $tool Tool */
        $account = $request->getAttribute(Account::class);
        $tool = $request->getAttribute(Tool::class);

        return new HtmlResponse($this->template->render('qrCodeGenerator/generate', ['tool' => $tool]));
    }

}
