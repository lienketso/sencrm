<?php


namespace History\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__.'/../../resources/views','nqadmin-history');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register(){
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
    }

}