<?php declare(strict_types=1);

namespace App\Controller\Forms;

use App\Http\HtmlResponse;
use App\Service\Forms\FormFieldService;
use App\Service\Forms\FormService;
use Laminas\Diactoros\Response\RedirectResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class FormPublicController
{

    public function __construct(
        private Engine $template,
        private FormService $formService,
        private FormFieldService $formFieldService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {
        if(empty($args['uuid']))
        {
            return new RedirectResponse('/');
        }

        $formInformation = $this->formService->getFormByUuid($args['uuid']);
        if($formInformation === FALSE)
        {
            return new RedirectResponse('/');
        }

        $formFields = $this->formFieldService->getAllFieldsForForm($formInformation['id']);

        return new HtmlResponse($this->template->render('forms/publicForm', [
            'formInformation' => $formInformation,
            'formFields' => $formFields
        ]));
    }

}
