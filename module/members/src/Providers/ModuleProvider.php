<?php


namespace Members\Providers;

use Barryvdh\Debugbar\ServiceProvider;
use Base\Supports\Helper;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'nqadmin-members');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function register()
    {
        Helper::loadModuleHelpers(__DIR__);
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
        $this->app->register(InstallModuleProvider::class);
        $this->app->register(MiddlewareProvider::class);

    }

}