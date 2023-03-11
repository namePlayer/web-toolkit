<?php
declare(strict_types=1);

namespace App\Controller;

use App\Http\HtmlResponse;
use Laminas\Diactoros\Response;
use League\Plates\Engine;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;

class IndexController
{

    public function __construct(private readonly Engine $template)
    {
    }

    public function load(RequestInterface $request): Response
    {

        return new HtmlResponse(
            $this->template->render('publicPage/index')
        );
    }

}
