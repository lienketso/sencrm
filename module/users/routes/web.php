<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 2:24 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'users';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('setting', 'UsersController@getSetting')
            ->name('nqadmin::users.setting.get')
            ->middleware('permission:user_index');

        $router->get('index', 'UsersController@getIndex')
            ->name('nqadmin::users.index.get')
            ->middleware('permission:user_index');

        $router->get('create', 'UsersController@getCreate')
            ->name('nqadmin::users.create.get')
            ->middleware('permission:user_create');

        $router->post('create', 'UsersController@postCreate')
            ->name('nqadmin::users.create.post')
            ->middleware('permission:user_create');

        $router->get('edit/{id}', 'UsersController@getEdit')
            ->name('nqadmin::users.edit.get')
            ->middleware('permission:user_edit');

        $router->post('edit/{id}', 'UsersController@postEdit')
            ->name('nqadmin::users.edit.post')
            ->middleware('permission:user_edit');

        $router->get('delete/{id}', 'UsersController@getDelete')
            ->name('nqadmin::users.delete.get')
            ->middleware('permission:user_delete');

        $router->get('profile/{id}','UsersController@getProfile')
            ->name('nqadmin::users.profile.get');
        $router->post('profile/{id}','UsersController@postProfile')
            ->name('nqadmin::users.profile.post');

        $router->get('enable', 'Google2FAController@enableTwoFactor')
            ->name('nqadmin::2fa.enable');

        $router->get('disable', 'Google2FAController@disableTwoFactor')
            ->name('nqadmin::2fa.disable');

        $router->post('disable', 'Google2FAController@disableTwoFactorPost')
            ->name('nqadmin::2fa.disable.post');
    });
});

