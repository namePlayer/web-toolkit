<?php declare(strict_types=1);
session_start();

require_once __DIR__.'/../vendor/autoload.php';

App\Software::initEnvironment();

require_once __DIR__.'/../config/container.php';

define("MESSAGES", new \App\PlatesExtension\Message\MessageList(
    $container->get(\Monolog\Logger::class))
);


require_once __DIR__.'/../config/routes.php';
