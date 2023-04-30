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
$router->post('/', 'App\Controller\IndexController::load');

$router->get('/authentication/registration', 'App\Controller\Authentication\RegistrationController::load');
$router->post('/authentication/registration', 'App\Controller\Authentication\RegistrationController::load');

$router->get('/authentication/login', 'App\Controller\Authentication\LoginController::load');
$router->post('/authentication/login', 'App\Controller\Authentication\LoginController::load');

$router->get('/authentication/lost-password', 'App\Controller\Authentication\LostPasswordController::load');
$router->post('/authentication/lost-password', 'App\Controller\Authentication\LostPasswordController::load');

$router->get('/authentication/reset-password', 'App\Controller\Authentication\ResetPasswordController::load');
$router->post('/authentication/reset-password', 'App\Controller\Authentication\ResetPasswordController::load');

$router->get('/authentication/activate-account', 'App\Controller\Authentication\ActivateAccountController::load');

$router->get('/authentication/twoFactor', 'App\Controller\Authentication\TwoFactorController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class]);
$router->post('/authentication/twoFactor', 'App\Controller\Authentication\TwoFactorController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class]);

$router->get('/authentication/logout', 'App\Controller\Authentication\LogoutController::load');

$router->get('/support', 'App\Controller\Support\SupportController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/security', 'App\Controller\Account\SecurityController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/security', 'App\Controller\Account\SecurityController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/security/addtwofactor', 'App\Controller\Account\AddTwoFactorController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/security/addtwofactor', 'App\Controller\Account\AddTwoFactorController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/security/removetwofactor/{id}', 'App\Controller\Account\RemoveTwoFactorController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/security/removetwofactor/{id}', 'App\Controller\Account\RemoveTwoFactorController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/security/allowip', 'App\Controller\Account\AllowIpAddressController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/security/allowip', 'App\Controller\Account\AllowIpAddressController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account', 'App\Controller\Account\AccountController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/admin/dashboard', 'App\Controller\Administration\DashboardController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/apikeys', 'App\Controller\Administration\ApiKeyController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/apikeys', 'App\Controller\Administration\ApiKeyController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/apikey/{id}', 'App\Controller\Administration\ApiKeyDetailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/apikey/{id}', 'App\Controller\Administration\ApiKeyDetailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/accounts', 'App\Controller\Administration\AccountListController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/account/{id}', 'App\Controller\Administration\AccountViewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/account/{id}', 'App\Controller\Administration\AccountViewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener', 'App\Controller\Administration\UrlShortener\ShortlinkDashboardController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener/alllinks', 'App\Controller\Administration\UrlShortener\AllLinksController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/urlshortener/alllinks', 'App\Controller\Administration\UrlShortener\AllLinksController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener/link/{id}', 'App\Controller\Administration\UrlShortener\LinkManagementController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/urlshortener/link/{id}', 'App\Controller\Administration\UrlShortener\LinkManagementController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/mails', 'App\Controller\Administration\MailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/mails', 'App\Controller\Administration\MailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/support', 'App\Controller\Administration\Support\SupportController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/support', 'App\Controller\Administration\Support\SupportController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/overview', 'App\Controller\Login\OverviewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/tool/url-shortener/list', 'App\Controller\URLShortener\ListController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/tool/url-shortener/view/{linkId}', 'App\Controller\URLShortener\LinkViewController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/tool/url-shortener/domains', 'App\Controller\URLShortener\DomainController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/tool/url-shortener/domains', 'App\Controller\URLShortener\DomainController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/tool/url-shortener', 'App\Controller\URLShortener\CreateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/tool/url-shortener', 'App\Controller\URLShortener\CreateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/aka/{shortcode}', 'App\Controller\URLShortener\LinkController::load');
$router->post('/aka/{shortcode}', 'App\Controller\URLShortener\LinkController::load');

$router->get('/api/shortlink', 'Api\UrlShortener\OpenLinkApiController::access')
    ->lazyMiddlewares([\App\Middleware\ApiAuthenticationMiddleware::class])
    ->setStrategy($jsonStrategy);

$response = $router->dispatch($request);
(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);

