<?php

namespace Task\Components\User\Login\Logic;

use Illuminate\Support\Facades\Auth;
use Task\Components\User\Login\Models\LoginUserInputModel;
use Task\Core\Messages\User\UserStatus;


class LoginUserRedirector
{
    public function checkAuth(LoginUserInputModel $model): ?string
    {
        if (!Auth::attempt(['email' => $model->email, 'password' => $model->password])) 
        {
            return UserStatus::emailAndPasswordNotMatch();
        }

        return null;
    }

    public function checkToken(string $token): ?string
    {
        if ($token == null) 
        {
            return UserStatus::userNotExists();
        }

        return null;
    }

}