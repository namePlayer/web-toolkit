<?php

namespace App\Middleware;

use App\Model\Tool\Tool;
use App\Table\Tool\ToolTable;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ToolMiddleware implements MiddlewareInterface
{

    public function __construct(
        private readonly ToolTable $toolTable
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getRequestTarget();
        $toolData = $this->toolTable->findByPath($path);

        if($toolData === FALSE) {
            return new RedirectResponse('/overview');
        }

        $tool = new Tool();
        $tool->setId($toolData['id']);
        $tool->setPath($path);
        $tool->setActive($toolData['active'] === 1);
        $tool->setTitle($toolData['title']);
        $tool->setDescription($toolData['description']);

        return $handler->handle($request->withAttribute(Tool::class, $tool));
    }
}