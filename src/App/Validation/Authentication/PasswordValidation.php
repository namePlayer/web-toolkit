<?php declare(strict_types=1);

namespace App\Validation\Authentication;

class PasswordValidation
{

    public function verify(string $password): void
    {

        if(mb_strlen($password) < 8)
        {
            MESSAGES->add('danger', 'password-minimum-requirements-not-met');
        }

    }

}
