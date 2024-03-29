<?php

declare(strict_types=1);

namespace App\PlatesExtension\Dynamics;

use AllowDynamicProperties;
use DateTime;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

#[AllowDynamicProperties]
class DynamicTextExtension implements ExtensionInterface
{


    public function register(Engine $engine): void
    {
        $engine->registerFunction('timeOfDayGreeting', [$this, 'timeOfDayGreeting']);
    }

    /** @noinspection PhpDuplicateMatchArmBodyInspection */
    public function timeOfDayGreeting(): string
    {
        $currentTime = (int)(new DateTime())->format('H');

        return match (true) {
            $currentTime >= 22 => 'user-greeting-night',
            $currentTime >= 17 => 'user-greeting-evening',
            $currentTime >= 12 => 'user-greeting-day',
            $currentTime >= 5 => 'user-greeting-morning',
            $currentTime >= 0 => 'user-greeting-night',
            default => 'user-greeting-hello'
        };
    }

}
