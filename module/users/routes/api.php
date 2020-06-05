<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 2:24 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'users';

Route::group(['prefix' => $moduleRoute], function(Router $router) use ($moduleRoute) {
    $router->get('get-user', 'ApiUsersController@getUsers')->name('ajax.users.get');
});