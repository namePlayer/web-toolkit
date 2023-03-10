<?php
declare(strict_types=1);

namespace App\Controller;

use App\Http\JsonResponse;
use App\Service\CacheService;
use App\Software;
use Laminas\Diactoros\Response;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;

class IndexController
{

    public function load(RequestInterface $request): Response
    {
        return new JsonResponse(200, ['Controller' => 'IndexController']);
    }

}
