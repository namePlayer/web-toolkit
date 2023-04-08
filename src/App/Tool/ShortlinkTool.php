<?php
declare(strict_types=1);

namespace App\Tool;

class ShortlinkTool
{

    /*
     * Default Information for Tool
     * */
    public const TOOL_DATABASE_ID = 1;
    public const TOOL_URL = '/tool/url-shortener';
    public const TOOL_VERSION = '1.0';
    public const TOOL_BETA = true;

    public static function getDefaultUrl(): string
    {
        return $_SERVER['HTTP_HOST'] . '/aka';
    }

}
