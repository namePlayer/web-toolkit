<?php declare(strict_types=1);

namespace App\Controller\Administration;

use App\Http\HtmlResponse;
use App\Service\Authentication\AccountService;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AccountViewController
{

    public function __construct(
        private readonly Engine $template,
        private readonly AccountService $accountService
    )
    {
    }

    public function load(ServerRequestInterface $request, array $args): ResponseInterface
    {

        return new HtmlResponse(
            $this->template->render('administration/accountView')
        );
    }

}
