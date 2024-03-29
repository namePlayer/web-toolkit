<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Service\Tool\ToolService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class ToolOverviewController
{

    public function __construct(
        private Engine      $template,
        private ToolService $toolService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('administration/toolOverview', ['tools' => $this->toolService->getAllTools()]));
    }

}
