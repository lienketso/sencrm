<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 12:00 PM
 */

namespace Setting\Providers;

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as ServiceProvider;

class RouteProvider extends ServiceProvider
{
    protected $namespace = 'Setting\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace
        ], function($router) {
            require __DIR__.'/../../routes/web.php';
        });
    }

    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api'
        ], function($router) {
            require __DIR__.'/../../routes/api.php';
        });
    }
}