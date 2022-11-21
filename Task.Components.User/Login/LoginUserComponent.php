<?php

namespace Task\Components\User\Login;

use Task\Components\User\Login\Logic\LoginUserRedirector;
use Task\Components\User\Login\Models\LoginUserInputModel;
use Task\Components\User\Login\Models\LoginUserResultModel;
use Task\Core\Components\BaseComponent;
use Task\Core\Messages\User\UserStatus;
use Task\Repositories\User\IUserRepository;
use Task\Services\Mapper\IMapperService;
use Task\Transfer\Queries\User\GetUserQuery;

class LoginUserComponent extends BaseComponent
{
    /**
    * @var IUserRepository
    */
    private $userRepository;

    /**
    * @var IMapperService
    */
    private $mapper;

    /**
    * @var LoginUserRedirector
    */
    private $redirector;

    public function __construct(
        IUserRepository $userRepository,

        IMapperService $mapper,

        LoginUserRedirector $redirector
    ) {
        parent::__construct();
        $this->userRepository = $userRepository;

        $this->mapper = $mapper;

        $this->redirector = $redirector;
    }

    /**
     * @param LoginUserInputModel $model for component
     * @return LoginUserResultModel model result for component
     */
    public function execute(LoginUserInputModel $model): LoginUserResultModel
    {
        $result = new LoginUserResultModel();

        $result->errorMessage = $this->redirector->checkAuth($model);

        if ($result->errorMessage)
        {
            $result->status = false;

            return $result;
        }

        $query = $this->mapper->map($model, GetUserQuery::class);

        $token = $this->userRepository->getUserAndGetToken($query);

        $result->errorMessage = $this->redirector->checkToken($token);

        if ($result->errorMessage)
        {
            $result->status = false;

            return $result;
        }

        $result->status = true;

        $result->message = UserStatus::loginUserSuccess();

        $result->token = $token;

        return $result;
    }
}