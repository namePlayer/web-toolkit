<?php

namespace App\Service\UrlShortener;

class ShortlinkPasswordService
{

    public function generatePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

}