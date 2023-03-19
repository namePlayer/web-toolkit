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

        if ($currentTime >= 22) {
            return 'user-greeting-night';
        } else if (($currentTime >= 17)) {
            return 'user-greeting-evening';
        } else if (($currentTime >= 12)) {
            return 'user-greeting-day';
        } else if ($currentTime >= 5) {
            return 'user-greeting-morning';
        } else if ($currentTime >= 0) {
            return 'user-greeting-night';
        } else {
            return 'user-greeting-hello';
        }

    }

}
