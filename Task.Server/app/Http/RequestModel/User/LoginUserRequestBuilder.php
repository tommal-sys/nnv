<?php

namespace App\Http\RequestModel\User;

use Task\Components\User\Login\Models\LoginUserInputModel;

class LoginUserRequestBuilder
{
    public static function build(array $inputData): LoginUserInputModel
    {
        $model = new LoginUserInputModel();

        $model->email = $inputData['email'];

        $model->password = $inputData['password'];

        return $model;
    }
}
