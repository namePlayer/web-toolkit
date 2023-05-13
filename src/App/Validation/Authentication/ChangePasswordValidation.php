<?php declare(strict_types=1);

namespace App\Validation\Authentication;

use App\DTO\Account\ChangePasswordDTO;

class ChangePasswordValidation
{

    public function __construct(
        private readonly PasswordValidation $passwordValidation
    )
    {
    }

    public function verify(ChangePasswordDTO $changePasswordDTO): bool
    {

        if(empty($changePasswordDTO->getNewPassword()))
        {
            MESSAGES->add('danger', 'account-settings-change-password-new-password-empty');
        }

        if($changePasswordDTO->getNewPassword() !== $changePasswordDTO->getRepeatNewPassword())
        {
            MESSAGES->add('danger', 'account-settings-change-password-not-match');
        }

        return MESSAGES->countByType('danger') === 0;
    }

}
