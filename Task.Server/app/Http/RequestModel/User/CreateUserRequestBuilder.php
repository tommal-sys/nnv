<?php

namespace App\Http\RequestModel\User;

use Task\Components\User\Create\Models\CreateUserInputModel;

class CreateUserRequestBuilder
{
    public static function build(array $inputData): CreateUserInputModel
    {
        $model = new CreateUserInputModel();

        $model->name = $inputData['name'];

        $model->email = $inputData['email'];

        $model->password = $inputData['password'];

        return $model;
    }
}
