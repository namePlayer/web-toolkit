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

$router->get('/products', 'App\Controller\ProductPageController::load');
$router->post('/products', 'App\Controller\ProductPageController::load');

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

$router->get('/support/ticket/{id}', 'App\Controller\Support\SupportTicketManageController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/support/ticket/{id}', 'App\Controller\Support\SupportTicketManageController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/support', 'App\Controller\Support\SupportController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/support', 'App\Controller\Support\SupportController::load')
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

$router->get('/account/organisation/invite', 'App\Controller\Account\OrganisationInviteController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/organisation/invite', 'App\Controller\Account\OrganisationInviteController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/organisation', 'App\Controller\Account\OrganisationController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/organisation', 'App\Controller\Account\OrganisationController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/licenses', 'App\Controller\Account\AccountLicenseController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/licenses', 'App\Controller\Account\AccountLicenseController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/address/{id}', 'App\Controller\Account\AddressViewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/address/{id}', 'App\Controller\Account\AddressViewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account/address', 'App\Controller\Account\AddressController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account/address', 'App\Controller\Account\AddressController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/account', 'App\Controller\Account\AccountController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/account', 'App\Controller\Account\AccountController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/admin/dashboard', 'App\Controller\Administration\DashboardController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/apikeys', 'App\Controller\Administration\ApiKeyController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/apikeys', 'App\Controller\Administration\ApiKeyController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/apikey/{id:number}', 'App\Controller\Administration\ApiKeyDetailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/apikey/{id:number}', 'App\Controller\Administration\ApiKeyDetailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/accounts', 'App\Controller\Administration\AccountListController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/accounts', 'App\Controller\Administration\AccountListController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/account/{id}', 'App\Controller\Administration\AccountViewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/account/{id}', 'App\Controller\Administration\AccountViewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/tools', 'App\Controller\Administration\ToolOverviewController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener', 'App\Controller\Administration\UrlShortener\ShortlinkDashboardController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener/alllinks', 'App\Controller\Administration\UrlShortener\AllLinksController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/urlshortener/alllinks', 'App\Controller\Administration\UrlShortener\AllLinksController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener/alldomains', 'App\Controller\Administration\UrlShortener\AllDomainsController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/urlshortener/alldomains', 'App\Controller\Administration\UrlShortener\AllDomainsController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener/link/{id}', 'App\Controller\Administration\UrlShortener\LinkManagementController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/urlshortener/link/{id}', 'App\Controller\Administration\UrlShortener\LinkManagementController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/urlshortener/domain/{id}', 'App\Controller\Administration\UrlShortener\DomainManagementController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/urlshortener/domain/{id}', 'App\Controller\Administration\UrlShortener\DomainManagementController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/mails', 'App\Controller\Administration\MailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/mails', 'App\Controller\Administration\MailController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/support/ticket/{id}', 'App\Controller\Administration\Support\SupportTicketController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/support/ticket/{id}', 'App\Controller\Administration\Support\SupportTicketController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);

$router->get('/admin/support/{module}', 'App\Controller\Administration\Support\SupportController::load')
    ->lazyMiddlewares([\App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class, \App\Middleware\AdminCheckMiddleware::class]);
$router->post('/admin/support/{module}', 'App\Controller\Administration\Support\SupportController::load')
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

$router->get('/tool/forms', 'App\Controller\Forms\FormsController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/tool/forms', 'App\Controller\Forms\FormsController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/tool/forms/edit/{uuid}', 'App\Controller\Forms\FormEditController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/tool/forms/edit/{uuid}', 'App\Controller\Forms\FormEditController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/form/{uuid}/{context}', 'App\Controller\Forms\FormPublicController::load');
$router->post('/form/{uuid}/{context}', 'App\Controller\Forms\FormPublicController::load');

$router->get('/form/{uuid}', 'App\Controller\Forms\FormPublicController::load');
$router->post('/form/{uuid}', 'App\Controller\Forms\FormPublicController::load');

$router->get('/tool/qrcodegen/{module}', 'App\Controller\QrCode\GenerateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/tool/qrcodegen/{module}', 'App\Controller\QrCode\GenerateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/tool/qrcodegen', 'App\Controller\QrCode\GenerateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);
$router->post('/tool/qrcodegen', 'App\Controller\QrCode\GenerateController::load')
    ->lazyMiddlewares([\App\Middleware\ToolMiddleware::class, \App\Middleware\AuthenticationMiddleware::class, \App\Middleware\TwoFactorMiddleware::class]);

$router->get('/api/shortlink', 'Api\UrlShortener\OpenLinkApiController::access')
    ->lazyMiddlewares([\App\Middleware\ApiAuthenticationMiddleware::class])
    ->setStrategy($jsonStrategy);

$response = $router->dispatch($request);
(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);

