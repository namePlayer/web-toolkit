<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\Tool\Tool;
use App\Table\Tool\ToolTable;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class ToolMiddleware implements MiddlewareInterface
{

    public function __construct(
        private ToolTable $toolTable
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getRequestTarget();
        $pathArray = explode('/', $path);
        if (count($pathArray) > 2) {
            $path = '/' . $pathArray[1] . '/' . $pathArray[2];
        }
        $toolData = $this->toolTable->findByPath($path);

        if ($toolData === false) {
            return new RedirectResponse('/overview');
        }

        $tool = new Tool();
        $tool->setId($toolData['id']);
        $tool->setPath($path);
        $tool->setActive($toolData['active'] === 1);
        $tool->setTitle($toolData['title']);
        $tool->setDescription($toolData['description']);
        $tool->setBeta($toolData['beta'] === 1);

        return $handler->handle($request->withAttribute(Tool::class, $tool));
    }
}
