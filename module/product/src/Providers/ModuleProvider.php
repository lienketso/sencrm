<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/9/2018
 * Time: 3:36 PM
 */

namespace Product\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'nqadmin-product');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
    }
}