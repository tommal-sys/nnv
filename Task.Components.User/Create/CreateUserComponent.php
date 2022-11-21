<?php

namespace Task\Components\User\Create;

use Task\Components\User\Create\Models\CreateUserInputModel;
use Task\Components\User\Create\Models\CreateUserResultModel;
use Task\Core\Components\BaseComponent;
use Task\Core\Messages\User\UserStatus;
use Task\Repositories\User\IUserRepository;
use Task\Services\Mapper\IMapperService;
use Task\Transfer\Queries\User\CreateUserQuery;

class CreateUserComponent extends BaseComponent
{
    /**
    * @var IUserRepository
    */
    private $userRepository;

    /**
    * @var IMapperService
    */
    private $mapper;

    public function __construct(
        IUserRepository $userRepository,

        IMapperService $mapper
    ) {
        parent::__construct();
        $this->userRepository = $userRepository;

        $this->mapper = $mapper;
    }

    /**
     * @param CreateUserInputModel $model for component
     * @return CreateUserResultModel model result for component
     */
    public function execute(CreateUserInputModel $model): CreateUserResultModel
    {
        $result = new CreateUserResultModel();
        
        $query = $this->mapper->map($model, CreateUserQuery::class);

        $token = $this->userRepository->createUserAndGetToken($query);

        $result->status = true;

        $result->message = UserStatus::createUserSuccess();

        $result->token = $token;

        return $result;
    }
}