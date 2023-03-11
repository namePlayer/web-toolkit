<?php declare(strict_types=1);
session_start();

require_once __DIR__.'/../vendor/autoload.php';
App\Software::initEnvironment();

const MESSAGES = new \App\PlatesExtension\Message\MessageList();

require_once __DIR__.'/../config/container.php';

require_once __DIR__.'/../config/routes.php';
