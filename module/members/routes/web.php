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
$moduleRoute = 'members';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('members', 'MembersController@getIndex')
            ->name('nqadmin::members.index.get');
//            ->middleware('permission:user_index');
    });
});

