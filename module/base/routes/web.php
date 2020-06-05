<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 11:51 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Auth\Http\Controllers\AuthController;

$adminRoute = config('base.admin_route');
$moduleRoute = 'dashboard';
//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('index', 'DashboardController@getIndex')->name('nqadmin::dashboard.index.get');
        $router->get('lang/{lang}','DashboardController@Languages')->name('nqadmin::dashboard.lang.get');
        $router->get('/sendmail/{id}', 'DashboardController@testMail');
    });
});
