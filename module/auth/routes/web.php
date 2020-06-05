<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 11:07 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'auth';

Route::get('', 'AuthController@redirectPath')->name('nqadmin::auth:login.redirect');
//Backend Route
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->get('/', function () use ($adminRoute, $moduleRoute) {
        return redirect()->to($adminRoute . '/' . $moduleRoute . '/login');
    });

    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('login', 'AuthController@getLogin')->name('nqadmin::auth.login.get');
        $router->post('login', 'AuthController@postLogin')->name('nqadmin::auth.login.post');
        $router->get('logout', 'AuthController@getLogout')->name('nqadmin::auth.logout.get');

        //Google 2FA
        $router->group(['prefix' => '2fa'], function (Router $router) {
            $router->get('validate', 'AuthController@getValidateToken')
                ->name('nqadmin::2fa.validate.get');

            $router->post('validate', 'AuthController@postValidateToken')
                ->name('nqadmin::2fa.validate.post')
                ->middleware('throttle:5');
        });
    });

});