<?php declare(strict_types=1);

use League\Container\Container;

$container = new Container();

#
# Controllers
#
$container->add(\App\Controller\IndexController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class);

$container->add(\App\Controller\Authentication\RegistrationController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Service\Authentication\TokenService::class)
    ->addArgument(\App\Service\MailerService::class);

$container->add(\App\Controller\Authentication\ActivateAccountController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\TokenService::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Controller\Authentication\LoginController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Service\Authentication\PasswordService::class)
    ->addArgument(\App\Service\MailerService::class)
    ->addArgument(\App\Service\Account\SecurityService::class);

$container->add(\App\Controller\Authentication\LostPasswordController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Service\MailerService::class);

$container->add(\App\Controller\Authentication\TwoFactorController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Account\SecurityService::class);

$container->add(\App\Controller\Account\AccountController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Controller\Account\SecurityController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Service\Account\SecurityService::class);

$container->add(\App\Controller\Account\AddTwoFactorController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Service\Account\SecurityService::class);

$container->add(\App\Controller\Authentication\ResetPasswordController::class)
    ->addArgument(\App\Service\Authentication\TokenService::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\League\Plates\Engine::class);

$container->add(\App\Controller\Login\OverviewController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\Tool\ToolService::class);

$container->add(\App\Controller\URLShortener\CreateController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkPasswordService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class);

$container->add(\App\Controller\URLShortener\LinkController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkPasswordService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkTrackingService::class);

$container->add(\App\Controller\URLShortener\DomainController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class);

$container->add(\App\Controller\URLShortener\ListController::class)
    ->addArgument(League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class);

$container->add(App\Controller\URLShortener\LinkViewController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkTrackingService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class);

$container->add(\Api\UrlShortener\OpenLinkApiController::class)
    ->addArgument(\App\Service\ApiKey\ApiKeyService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkPasswordService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkTrackingService::class);

$container->add(\App\Controller\Administration\ApiKeyDetailController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\ApiKey\ApiKeyService::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Controller\Administration\DashboardController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Controller\Administration\ApiKeyController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\ApiKey\ApiKeyService::class);

$container->add(\App\Controller\Administration\AccountListController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Controller\Administration\AccountViewController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Table\Authentication\AccountLevelTable::class)
    ->addArgument(\App\Service\MailerService::class);

$container->add(\App\Controller\Administration\MailController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\MailerService::class);

#
# Services
#
$container->add(\App\Service\CacheService::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Table\Authentication\AccountTable::class)
    ->addArgument(\App\Service\Authentication\PasswordService::class)
    ->addArgument(\App\Validation\Authentication\RegisterValidation::class)
    ->addArgument(\App\Table\Authentication\AccountLevelTable::class)
    ->addArgument(\App\Validation\Authentication\PasswordResetValidation::class)
    ->addArgument(\App\Validation\Authentication\SetNewPasswordValidation::class)
    ->addArgument(\App\Service\Authentication\TokenService::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\Service\Authentication\PasswordService::class);

$container->add(\App\Service\Tool\ToolService::class)
    ->addArgument(\App\Table\Tool\ToolTable::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Table\UrlShortener\ShortlinkTable::class)
    ->addArgument(\App\Validation\UrlShortener\ShortlinkValidation::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkTrackingService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class);

$container->add(\App\Service\UrlShortener\ShortlinkPasswordService::class);

$container->add(\App\Service\UrlShortener\ShortlinkTrackingService::class)
    ->addArgument(\App\Table\UrlShortener\ShortlinkTrackingTable::class);

$container->add(\App\Service\UrlShortener\ShortlinkDomainService::class)
    ->addArgument(\App\Table\UrlShortener\ShortlinkDomainTable::class)
    ->addArgument(\App\Validation\UrlShortener\ShortlinkDomainValidation::class);

$container->add(\App\Controller\Administration\UrlShortener\ShortlinkDashboardController::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkService::class)
    ->addArgument(\App\Service\UrlShortener\ShortlinkDomainService::class);

$container->add(\App\Service\ApiKey\ApiKeyService::class)
    ->addArgument(\App\Table\ApiKey\ApiKeyTable::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Service\Authentication\TokenService::class)
    ->addArgument(\App\Table\Authentication\TokenTable::class);

$container->add(\App\Service\MailerService::class)
    ->addArgument(\App\Factory\MailerFactory::class)
    ->addArgument(\App\Table\Mail\MailTable::class)
    ->addArgument(\League\Plates\Engine::class)
    ->addArgument(\Monolog\Logger::class);

$container->add(\App\Service\Account\SecurityService::class)
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Table\Account\TwoFactorTable::class);

#
# Repositories
#
$container->add(\App\Table\Authentication\AccountTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\Authentication\AccountLevelTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\Tool\ToolTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\UrlShortener\ShortlinkTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\UrlShortener\ShortlinkTrackingTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\UrlShortener\ShortlinkDomainTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\ApiKey\ApiKeyTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\Authentication\TokenTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\Mail\MailTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

$container->add(\App\Table\Account\TwoFactorTable::class)
    ->addArgument(\Envms\FluentPDO\Query::class);

#
# Validations
#
$container->add(\App\Validation\Authentication\RegisterValidation::class);

$container->add(\App\Validation\UrlShortener\ShortlinkValidation::class);

$container->add(\App\Validation\UrlShortener\ShortlinkDomainValidation::class);

$container->add(\App\Validation\Authentication\PasswordResetValidation::class);

$container->add(\App\Validation\Authentication\PasswordValidation::class);

$container->add(\App\Validation\Authentication\SetNewPasswordValidation::class)
    ->addArgument(\App\Validation\Authentication\PasswordValidation::class);

#
# Middlewares
#
$container->add(\App\Middleware\AuthenticationMiddleware::class)
    ->addArgument(\App\Service\Authentication\AccountService::class);

$container->add(\App\Middleware\ToolMiddleware::class)
    ->addArgument(\App\Table\Tool\ToolTable::class);

$container->add(\App\Middleware\AdminCheckMiddleware::class);

$container->add(\App\Middleware\ApiAuthenticationMiddleware::class)
    ->addArgument(\App\Service\ApiKey\ApiKeyService::class);

$container->add(\App\Middleware\TwoFactorMiddleware::class)
    ->addArgument(\App\Service\Account\SecurityService::class);

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
    ->addArgument(\App\Service\Authentication\AccountService::class)
    ->addArgument(\App\Table\Authentication\AccountLevelTable::class);

$container->add(\App\PlatesExtension\Dynamics\DynamicTextExtension::class);

$container->add(\App\Factory\MailerFactory::class)
    ->addArgument(\PHPMailer\PHPMailer\PHPMailer::class);

$container->add(\PHPMailer\PHPMailer\PHPMailer::class)
    ->addArgument(true);

$responseFactory = (new \Laminas\Diactoros\ResponseFactory());
$jsonStrategy = (new \League\Route\Strategy\JsonStrategy($responseFactory))->setContainer($container);
$applicationStrategy = (new \League\Route\Strategy\ApplicationStrategy())->setContainer($container);
$router = (new \League\Route\Router())->setStrategy($applicationStrategy);
