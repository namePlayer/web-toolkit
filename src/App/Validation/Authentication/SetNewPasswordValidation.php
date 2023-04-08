<?php
declare(strict_types=1);

namespace App\Validation\Authentication;

use App\Model\Authentication\Account;

readonly class SetNewPasswordValidation
{

    public function __construct(
        private PasswordValidation $passwordValidation
    ) {
    }

    public function verify(Account $account, string $passwordCheck): bool
    {
        if ($account->getPassword() !== $passwordCheck) {
            MESSAGES->add('danger', 'reset-password-password-not-match');
        }

        $this->passwordValidation->verify($account->getPassword());

        return MESSAGES->countByType('danger') === 0;
    }

}
