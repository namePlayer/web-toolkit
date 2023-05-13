<?php

declare(strict_types=1);

namespace App\DTO\Account;

class ChangePasswordDTO
{

    private int $account;
    private string $oldPassword;
    private string $newPassword;
    private string $repeatNewPassword;

    public function getAccount(): int
    {
        return $this->account;
    }

    public function setAccount(int $account): void
    {
        $this->account = $account;
    }

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    public function getRepeatNewPassword(): string
    {
        return $this->repeatNewPassword;
    }

    public function setRepeatNewPassword(string $repeatNewPassword): void
    {
        $this->repeatNewPassword = $repeatNewPassword;
    }

}
