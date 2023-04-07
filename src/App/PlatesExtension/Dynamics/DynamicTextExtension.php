<?php
declare(strict_types=1);

namespace App\PlatesExtension\Dynamics;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

#[\AllowDynamicProperties]
class DynamicTextExtension implements ExtensionInterface
{


    public function register(Engine $engine)
    {
        $engine->registerFunction('timeOfDayGreeting', [$this, 'timeOfDayGreeting']);
    }

    public function timeOfDayGreeting(): string
    {

        $currentTime = (int)(new \DateTime())->format('H');

        return match(true) {
            $currentTime >= 22 => 'user-greeting-night',
            $currentTime >= 17 => 'user-greeting-evening',
            $currentTime >= 12 => 'user-greeting-day',
            $currentTime >= 5 => 'user-greeting-morning',
            $currentTime >= 0 => 'user-greeting-night',
            default => 'user-greeting-hello'
        };

    }

}
