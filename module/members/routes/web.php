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
        $router->get('network', 'MembersController@getIndex')
            ->name('nqadmin::members.index.get')
            ->middleware('permission:member_index');
        $router->get('create','MembersController@getCreate')
            ->name('nqadmin::members.create.get')
            ->middleware('permission:member_create');
        $router->post('create','MembersController@postCreate')
            ->name('nqadmin::members.create.post')
            ->middleware('permission:member_create');
        $router->get('edit/{id}','MembersController@getEdit')
            ->name('nqadmin::members.edit.get')
            ->middleware('permission:member_edit');
        $router->post('edit/{id}','MembersController@postEdit')
            ->name('nqadmin::members.edit.post')
            ->middleware('permission:member_edit');
        $router->get('delete/{id}','MembersController@getDelete')
            ->name('nqadmin::members.delete.get')
            ->middleware('permission:member_delete');
    });
});

