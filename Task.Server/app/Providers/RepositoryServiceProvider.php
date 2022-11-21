<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Task\Repositories\Picture\PictureRepository;
use Task\Repositories\Picture\IPictureRepository;
use Task\Repositories\User\UserRepository;
use Task\Repositories\User\IUserRepository;

/**
 * Class CoreServiceProviders
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPictureRepository::class, PictureRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}