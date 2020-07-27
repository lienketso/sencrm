<?php

namespace Guest\Providers;

use Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;


class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'guest');
    }

    public function register()
    {
        Helper::loadModuleHelpers(__DIR__);
        $this->app->register(RouteProvider::class);
    }
}