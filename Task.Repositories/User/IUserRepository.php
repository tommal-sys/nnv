<?php

namespace Task\Repositories\User;

use Task\Transfer\Queries\User\GetUserQuery;
use Task\Transfer\Queries\User\CreateUserQuery;

interface IUserRepository
{
    public function getUserAndGetToken(GetUserQuery $query): ?string;

    public function createUserAndGetToken(CreateUserQuery $query): string;
}
