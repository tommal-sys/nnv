<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\RequestModel\User\CreateUserRequestBuilder;
use App\Http\RequestModel\User\LoginUserRequestBuilder;
use App\Http\Requests\Api\User\CreateUserApiRequest;
use App\Http\Requests\Api\User\LoginUserApiRequest;
use Task\Components\User\Create\CreateUserComponent;
use Task\Components\User\Login\LoginUserComponent;
use Task\Core\Components\IComponentDispatcher;

class AuthController extends BaseController
{
    /**
     * @var IComponentDispatcher
     */
    private $componentDispatcher;

    public function __construct(
        IComponentDispatcher $componentDispatcher
    ) {
        $this->componentDispatcher = $componentDispatcher;
    }

    public function createUser(CreateUserApiRequest $request)
    { 
        $model = CreateUserRequestBuilder::build($request->all());
        
        $context = $this->componentDispatcher->dispatch(CreateUserComponent::class, $model);

        if($context->error)
        {
            return $this->jsonUnexpectedError($context->error);
        }

        return $this->json($context->result);
    }

    public function loginUser(LoginUserApiRequest $request)
    {
        $model = LoginUserRequestBuilder::build($request->all());

        $context = $this->componentDispatcher->dispatch(LoginUserComponent::class, $model);

        if($context->error)
        {
            return $this->jsonUnexpectedError($context->error);
        }

        if($context->result->errorMessage != null)
        {
            return $this->jsonUnexpectedError($context->result->errorMessage);
        }

        return $this->json($context->result);
    }
}
