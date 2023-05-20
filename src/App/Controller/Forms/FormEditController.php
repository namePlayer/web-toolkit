<?php declare(strict_types=1);

namespace App\Controller\Forms;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Tool\Tool;
use App\Service\Forms\FormFieldService;
use App\Service\Forms\FormService;
use App\Tool\FormsTool;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormEditController
{

    public function __construct(
        private readonly Engine $template,
        private readonly FormService $formService,
        private readonly FormFieldService $formFieldService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool */
        $tool = $request->getAttribute(Tool::class);

        if(empty($args['uuid']))
        {
            return new RedirectResponse(FormsTool::TOOL_URL);
        }

        $form = $this->formService->getFormByUuid($args['uuid']);
        if($form === FALSE || $form['account'] !== $account->getId())
        {
            return new RedirectResponse(FormsTool::TOOL_URL);
        }

        return new HtmlResponse($this->template->render('forms/editFormPage', [
            'tool' => $tool,
            'form' => $form,
            'fieldTypes' => $this->formFieldService->getAllAvailableFields(),
            'fields' => []
        ]));
    }

}
