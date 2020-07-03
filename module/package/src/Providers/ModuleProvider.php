<?php

namespace Package\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__.'/../../resources/views','nqadmin-package');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
    public function register(){
        $this->app->register(RouterProvider::class);
        $this->app->register(HookProvider::class);
    }
}