<?php declare(strict_types=1);

namespace App\Validation\Authentication;

use App\Model\Authentication\Account;

class PasswordResetValidation
{

    public function verify(Account $account): bool
    {
        if (!filter_var($account->getEmail(), FILTER_VALIDATE_EMAIL)) {
            MESSAGES->add('danger', 'reset-password-invalid-email-provided');
        }

        return MESSAGES->countByType('danger') === 0;
    }

}
