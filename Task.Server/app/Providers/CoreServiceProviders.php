<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Task\Core\Components\ComponentDispatcher;
use Task\Core\Components\IComponentDispatcher;

/**
 * Class CoreServiceProviders
 * @package App\Providers
 */
class CoreServiceProviders extends ServiceProvider
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
        $this->app->bind(IComponentDispatcher::class, ComponentDispatcher::class);
    }
}
