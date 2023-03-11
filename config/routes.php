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

$response = $router->dispatch($request);
(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
