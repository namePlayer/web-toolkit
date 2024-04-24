<?php
declare(strict_types=1);

namespace App\Controller;

use App\Http\HtmlResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductPageController
{

    public function __construct(
        private readonly Engine $template
    )
    {
    }

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('publicPage/products'));
    }

}
