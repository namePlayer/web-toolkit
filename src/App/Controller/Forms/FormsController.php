<?php

declare(strict_types=1);

namespace App\Controller\Forms;

use App\Http\HtmlResponse;
use App\Model\Authentication\Account;
use App\Model\Forms\Form;
use App\Model\Tool\Tool;
use App\Service\Forms\FormService;
use App\Service\UrlShortener\ShortlinkService;
use App\Tool\FormsTool;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class FormsController
{

    public function __construct(
        private Engine          $template,
        private FormService     $formService
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        /* @var $account Account */
        $account = $request->getAttribute(Account::class);
        /* @var $tool Tool */
        $tool = $request->getAttribute(Tool::class);

        if($request->getMethod() === 'POST')
        {
            $create = $this->create($account);
            if($create instanceof ResponseInterface)
            {
                return $create;
            }
        }

        return new HtmlResponse(
            $this->template->render(
                'forms/mainPage',
                [
                    'tool' => $tool,
                    'formList' => $this->formService->getAllFormsForAccount($account->getId())
                ],
            )
        );
    }

    private function create(Account $account): ?ResponseInterface
    {
        if(isset($_POST['formsToolCreateModalFormTitle'], $_POST['formsToolCreateModalFormTemplate']))
        {

            $form = new Form();
            $form->setAccount($account->getId());
            $form->setName(trim($_POST['formsToolCreateModalFormTitle']));

            $createForm = $this->formService->create($form);
            if(is_string($createForm))
            {
                return new RedirectResponse(FormsTool::TOOL_URL . '/edit/' . $createForm);
            }

        }

        return null;
    }

}
