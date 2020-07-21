<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 10:58 PM
 */

namespace Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Base\Supports\Helper;
use Auth;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(255);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'nqadmin-dashboard');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../resources/public' => public_path(),
        ], 'nqadmin-public-assets');

        $this->app->booted(function () {
            $this->booted();
        });
    }

    public function booted()
    {
        $currentUrl = url()->current();
        $check = explode('/', $currentUrl);
    }

    public function register()
    {
        //Load helpers
        Helper::loadModuleHelpers(__DIR__);

        config([
            'auth.defaults' => [
                'guard' => 'nqadmin',
                'passwords' => 'admin-users',
            ],
            'auth.guards.nqadmin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'auth.providers.admin-users' => [
                'driver' => 'eloquent',
                'model' => \Users\Models\Users::class,
                'table' => 'users'
            ],
            'auth.passwords.admin-users' => [
                'provider' => 'admin-users',
                'table' => 'password_resets',
                'expire' => 60,
            ],
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../../config/base.php', 'base');
        $this->mergeConfigFrom(__DIR__ . '/../../config/lfm.php', 'lfm');
        $this->mergeConfigFrom(__DIR__ . '/../../config/messages.php', 'messages');
        $this->mergeConfigFrom(__DIR__ . '/../../config/paypal.php', 'paypal');

        $this->publishes([
            __DIR__ . '/../../../../vendor/unisharp/laravel-filemanager/public' => public_path('vendor/laravel-filemanager'),
        ], 'public');

        /**
         * Module provider
         */
        $this->app->register(RouteProvider::class);


        //Register related facades
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        $loader->alias('Image', \Intervention\Image\Facades\Image::class);
        $loader->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);
        $loader->alias('Socialite', \Laravel\Socialite\Facades\Socialite::class);
        $loader->alias('Cart', \Gloudemans\Shoppingcart\Facades\Cart::class);
        /**
         * Other packages
         */
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);
        $this->app->register(\Prettus\Repository\Providers\RepositoryServiceProvider::class);
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->app->register(\Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class);
        $this->app->register(\Gloudemans\Shoppingcart\ShoppingcartServiceProvider::class);

        /**
         * Other module providers
         */
        $this->app->register(\Auth\Providers\ModuleProvider::class);
        $this->app->register(\Hook\Providers\ModuleProvider::class);
        $this->app->register(\Acl\Providers\ModuleProvider::class);
        $this->app->register(\Users\Providers\ModuleProvider::class);
        $this->app->register(\Members\Providers\ModuleProvider::class);
        $this->app->register(\History\Providers\ModuleProvider::class);
        $this->app->register(\Product\Providers\ModuleProvider::class);
        $this->app->register(\Package\Providers\ModuleProvider::class);
        $this->app->register(\Shoping\Providers\ModuleProvider::class);
        $this->app->register(\Transaction\Providers\ModuleProvider::class);
    }
}