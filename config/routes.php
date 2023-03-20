<?php declare(strict_types=1);

use League\Route\Router;

$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

/* @var Router $router */
$router->get('/', 'App\Controller\IndexController::load');

$router->get('/authentication/registration', 'App\Controller\Authentication\RegistrationController::load');
$router->post('/authentication/registration', 'App\Controller\Authentication\RegistrationController::load');

$router->get('/authentication/login', 'App\Controller\Authentication\LoginController::load');
$router->post('/authentication/login', 'App\Controller\Authentication\LoginController::load');

$router->get('/authentication/logout', 'App\Controller\Authentication\LogoutController::load');

$router->get('/authentication/account', 'App\Controller\Authentication\AccountController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class]);

$router->get('/admin/dashboard', 'App\Controller\Administration\DashboardController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/apikeys', 'App\Controller\Administration\ApiKeyController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/overview', 'App\Controller\Login\OverviewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class]);

$router->get('/tool/url-shortener/list', 'App\Controller\URLShortener\ListController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);

$router->get('/tool/url-shortener/view/{linkId}', 'App\Controller\URLShortener\LinkViewController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);

$router->get('/tool/url-shortener/domains', 'App\Controller\URLShortener\DomainController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);
$router->post('/tool/url-shortener/domains', 'App\Controller\URLShortener\DomainController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);

$router->get('/tool/url-shortener', 'App\Controller\URLShortener\CreateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);
$router->post('/tool/url-shortener', 'App\Controller\URLShortener\CreateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);


$router->get('/aka/{shortcode}', 'App\Controller\URLShortener\LinkController::load');
$router->post('/aka/{shortcode}', 'App\Controller\URLShortener\LinkController::load');

$response = $router->dispatch($request);
(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);

