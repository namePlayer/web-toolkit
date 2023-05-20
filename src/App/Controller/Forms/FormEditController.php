<?php declare(strict_types=1);

namespace App\Controller\Forms;

use App\DTO\Forms\AddNewFieldDTO;
use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Forms\FormField;
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

        if($request->getMethod() === "POST" && isset($_POST['formsToolAddNewFieldSubmit']))
        {
            $this->addField($form['id']);
        }

        return new HtmlResponse($this->template->render('forms/editFormPage', [
            'tool' => $tool,
            'form' => $form,
            'fieldTypes' => $this->formFieldService->getAllAvailableFields(),
            'fields' => $this->formFieldService->getAllFieldsForForm($form['id'])
        ]));
    }

    private function addField(int $form): void
    {

        if(isset($_POST['formsToolAddNewFieldTitle'], $_POST['formsToolAddNewFieldDescription'], $_POST['formsToolAddNewFieldType']))
        {

            $formField = new FormField();
            $formField->setForm($form);
            $formField->setTitle($_POST['formsToolAddNewFieldTitle']);
            $formField->setDescription($_POST['formsToolAddNewFieldDescription']);
            $formField->setType((int)$_POST['formsToolAddNewFieldType']);

            $this->formFieldService->create($formField);

        }

    }

}
