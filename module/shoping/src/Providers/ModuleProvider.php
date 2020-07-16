<?php


namespace Shoping\Providers;

use Illuminate\Support\ServiceProvider;
use Shoping\Providers\HookProvider;
use Shoping\Providers\RouterProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__.'/../../resources/views','nqadmin-shoping');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
    public function register(){
        $this->app->register(RouterProvider::class);
        $this->app->register(HookProvider::class);
    }
}