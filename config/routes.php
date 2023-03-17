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

$router->get('/admin/dashboard', 'App\Controller\Administration\DashboardController::load');

$router->get('/overview', 'App\Controller\Login\OverviewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class]);

$router->get('/tool/url-shortener', 'App\Controller\URLShortener\CreateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);

$router->get('/aka/{shortcode}', 'App\Controller\URLShortener\LinkController::load');
$router->post('/aka/{shortcode}', 'App\Controller\URLShortener\LinkController::load');

$router->post('/tool/url-shortener', 'App\Controller\URLShortener\CreateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class]);

$response = $router->dispatch($request);
(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);

