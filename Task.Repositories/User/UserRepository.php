<?php

namespace Task\Repositories\User;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Task\Core\Cache\CacheKeys;
use Task\Models\User\User;
use Task\Repositories\User\IUserRepository;
use Task\Services\Cache\ICacheService;
use Task\Transfer\Queries\User\GetUserQuery;
use Task\Transfer\Queries\User\CreateUserQuery;

class UserRepository implements IUserRepository
{
    /** 
     * @var ICacheService 
     */
    public $cacheService;

    public function __construct(

        ICacheService $cacheService
    ) {

        $this->cacheService = $cacheService;

        $this->token = Config::get('token.api');
    }
    
    public function getUserAndGetToken(GetUserQuery $query): ?string
    {
        $cacheKey = CacheKeys::PICTURE_SINGLE . $query->email;
        
        $dto = $this->cacheService->rememberForFewSecounds($cacheKey, function () use ($query) 
        {
            $user = User::select('id', 'name', 'email');
            
            if($query->email !== null)
            {
                $user = $user->where('email', $query->email);
            }

            $user = $user->first();

            if(!$user) return null;

            return $user->createToken($this->token)->plainTextToken;    
        });

        return $dto;
    }

    public function createUserAndGetToken(CreateUserQuery $query): string
    {
        $user = new User();

        $user->name = $query->name;

        $user->email = $query->email;

        $user->password = Hash::make($query->password);

        $user->save();

        return $user->createToken($this->token)->plainTextToken;
    }

}
