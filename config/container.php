<?php declare(strict_types=1);

use League\Container\Container;

$container = new Container();

#
# Controllers
#
$container->add(\App\Controller\IndexController::class)
    ->addArgument(League\Plates\Engine::class);

$container->add(\App\Controller\Authentication\RegistrationController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Controller\Authentication\LoginController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Service\Authentication\PasswordService::class);

$container->add(\App\Controller\Login\OverviewController::class)
    ->addArgument(League\Plates\Engine::class);

#
# Services
#
$container->add(\App\Service\CacheService::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Table\Authentication\AccountTable::class)
    ->addArgument(\App\Service\Authentication\PasswordService::class)
    ->addArgument(\App\Validation\Authentication\RegisterValidation::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\Service\Authentication\PasswordService::class);

#
# Repositories
#
$container->add(\App\Table\Authentication\AccountTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

#
# Validations
#
$container->add(\App\Validation\Authentication\RegisterValidation::class);

#
# Middlewares
#
$container->add(\App\Middleware\AuthenticationMiddleware::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

#
# Dependencies
#
$container->add(PDO::class)
    ->addArgument('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'])
    ->addArgument($_ENV['DB_USER'])
    ->addArgument($_ENV['DB_PASSWORD']);

$container->add(\Envms\FluentPDO\Query::class)
    ->addArgument(PDO::class);

$container->add(\Monolog\Logger::class)
    ->addArgument('app')
    ->addMethodCall('pushHandler',
        [(new \App\Factory\LoggerFactory())->createPushHandler()]
    );

$container->add(League\Plates\Engine::class)
    ->addArgument(__DIR__.'/../template')
    ->addMethodCall('loadExtension', [\App\PlatesExtension\Translator\TranslationExtension::class])
    ->addMethodCall('loadExtension', [\App\PlatesExtension\Authentication\AuthenticationExtension::class])
    ->addMethodCall('loadExtension', [\App\PlatesExtension\Dynamics\DynamicTextExtension::class]);

$container->add(\App\PlatesExtension\Translator\TranslationExtension::class)
    ->addArgument(\App\PlatesExtension\Translator\Translation::class);

$container->add(\App\PlatesExtension\Translator\Translation::class)
    ->addArgument(\App\PlatesExtension\Translator\JsonTranslation::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\PlatesExtension\Translator\JsonTranslation::class);

$container->add(\App\PlatesExtension\Authentication\AuthenticationExtension::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\PlatesExtension\Dynamics\DynamicTextExtension::class);

$responseFactory = (new \Laminas\Diactoros\ResponseFactory());
$jsonStrategy = (new \League\Route\Strategy\JsonStrategy($responseFactory))->setContainer($container);
$applicationStrategy = (new \League\Route\Strategy\ApplicationStrategy())->setContainer($container);
$router = (new \League\Route\Router())->setStrategy($applicationStrategy);
