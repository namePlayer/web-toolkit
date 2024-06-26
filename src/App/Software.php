<?php

declare(strict_types=1);

namespace App;

use App\Exception\EnvironmentException;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Dotenv\Exception\PathException;

class Software
{

    public const VERSION = '0.0.1';
    public const BUILD = '000001';
    public const TYPE = 'dev';

    public const CACHE_DIR = __DIR__ . '/../../data/cache';
    public const LOG_DIR = __DIR__ . '/../../data/log';
    public const PERSISTENT_DIR = __DIR__ . '/../../data/persistent';

    public const LOG_FILENAME = 'app.log';
    public const CONSOLE_LOG_FILENAME = 'console.log';

    public const DATABASE_TIME_FORMAT = 'Y-m-d H:i:s';
    public const SESSION_USERID_NAME = 'webtoolkit_login_id';
    public const SESSION_TFA_NAME = 'webtoolkit_login_tfa';

    public const DISCORD_INVITE = 'https://discord.gg/RwxEQ7Gcmm';


    /**
     * @throws EnvironmentException
     */
    public static function initEnvironment(string $location = __DIR__ . '/../../.env'): void
    {
        $envLoad = new Dotenv();

        try {
            $envLoad->load($location);
        } catch (PathException $exception) {
            die('Could not open Environment File');
        }

        if (!isset($_ENV['SOFTWARE_TIMEZONE'])) {
            throw new EnvironmentException('SOFTWARE_TIMEZONE');
        }

        if (!isset($_ENV['SOFTWARE_TITLE'])) {
            throw new EnvironmentException('SOFTWARE_TITLE');
        }

        if (!isset($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'])) {
            throw new EnvironmentException('DB_HOST, DB_NAME, DB_USER or DB_PASSWORD');
        }

        if (!isset($_ENV['SOFTWARE_PRODUCTION'])) {
            $_ENV['SOFTWARE_PRODUCTION'] = false;
        }

        if(isset($_ENV['SOFTWARE_ENABLE_REGISTRATION']))
        {
            $_ENV['SOFTWARE_ENABLE_REGISTRATION'] = $_ENV['SOFTWARE_ENABLE_REGISTRATION'] == "true";
        }

        date_default_timezone_set($_ENV['SOFTWARE_TIMEZONE']);
    }

}
