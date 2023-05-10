<?php declare(strict_types=1);

namespace App\Service\Security;

class SecurityKeyService
{

    public function generate(int $length = 5): string
    {
        return bin2hex(random_bytes($length));
    }

}
