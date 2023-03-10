<?php declare(strict_types=1);

use League\Container\Container;

$container = new Container();

#
# Controllers
#
$container->add(\App\Controller\IndexController::class);

#
# Services
#
$container->add(\App\Service\CacheService::class)
    ->addArgument(\Monolog\Logger::class);

#
# Repositories
#

#
# Dependencies
#
$container->add(\Envms\FluentPDO\Query::class)
    ->addArgument('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'])
    ->addArgument($_ENV['DB_USER'])
    ->addArgument($_ENV['DB_PASSWORD']);

$container->add(\Monolog\Logger::class)
    ->addArgument('app')
    ->addMethodCall('pushHandler',
        [(new \App\Factory\LoggerFactory())->createPushHandler()]
    );

$responseFactory = (new \Laminas\Diactoros\ResponseFactory());
$strategy = (new \League\Route\Strategy\JsonStrategy($responseFactory))->setContainer($container);
$router = (new \League\Route\Router())->setStrategy($strategy);
