<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 11:55 AM
 */

namespace Setting\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'nqadmin-setting');
    }

    public function register()
    {
        $this->app->register(HookProvider::class);
        $this->app->register(RouteProvider::class);
    }
}