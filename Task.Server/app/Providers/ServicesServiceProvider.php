<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Task\Services\Cache\RedisService;
use Task\Services\Cache\ICacheService;
use Task\Services\Image\ImageService;
use Task\Services\Image\IImageService;
use Task\Services\Logger\LoggerService;
use Task\Services\Logger\ILoggerService;
use Task\Services\Mapper\MapperService;
use Task\Services\Mapper\IMapperService;

/**
 * Class CoreServiceProviders
 * @package App\Providers
 */
class ServicesServiceProvider extends ServiceProvider
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
        $this->app->bind(ICacheService::class, RedisService::class);
        $this->app->bind(ILoggerService::class, LoggerService::class);
        $this->app->bind(IImageService::class, ImageService::class);
        $this->app->bind(IMapperService::class, MapperService::class);
    }
}
