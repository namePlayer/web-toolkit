<?php

namespace App\Validation\Authentication;

use App\Model\Authentication\Account;

class RegisterValidation
{

    public function verify(Account $account): bool
    {

        if(filter_var($account->getEmail(), FILTER_VALIDATE_EMAIL) === FALSE)
        {
            MESSAGES->add('danger', 'invalid-email');
        }

        if(empty($account->getPassword()))
        {
            MESSAGES->add('danger', 'password-empty');
        }

        if(empty($account->getName()))
        {
            MESSAGES->add('danger', 'account-name-empty');
        }

        if(mb_strlen($account->getName()) >= 100)
        {
            MESSAGES->add('danger', 'account-name-max-length');
        }

        return MESSAGES->countByType('danger') === 0;

    }

}