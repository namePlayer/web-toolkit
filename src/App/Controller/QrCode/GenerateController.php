<?php declare(strict_types=1);

namespace App\Controller\QrCode;

use App\Factory\QrCodeGeneratorFactory;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Service\QrCodeGenerator\QrCodeGeneratorService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class GenerateController
{

    public function __construct(
        private QrCodeGeneratorService $qrCodeGeneratorService,
        private Engine $template
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        /* @var $tool Tool */
        $account = $request->getAttribute(Account::class);
        $tool = $request->getAttribute(Tool::class);

        $modules = ['text', 'website', 'wifi', 'contact', 'email'];
        $module = 'text';
        if(isset($args['module']) && in_array($args['module'], $modules))
        {
            $module = $args['module'];
        }

        return new HtmlResponse($this->template->render('qrCodeGenerator/generate',
            ['tool' => $tool, 'module' => $module]
        ));
    }

    public function create(ServerRequestInterface $request, string $module)
    {

    }

}
