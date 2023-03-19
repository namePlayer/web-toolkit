<?php
declare(strict_types=1);

namespace App\Controller\Authentication;

use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController
{

    public function load(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();

        return new RedirectResponse('/authentication/login');
    }

}
