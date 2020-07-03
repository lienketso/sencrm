<?php

$adminRoute = config('base.admin_route');
$moduleRoute = 'package';

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::group(['prefix'=>$adminRoute], function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute], function(Router $router){
        $router->get('index','PackageController@getIndex')
            ->name('nqadmin::package.index.get')
            ->middleware('permission:package_index');

        $router->get('create','PackageController@getCreate')
            ->name('nqadmin::package.create.get')
            ->middleware('permission:package_create');

        $router->post('create','PackageController@postCreate')
            ->name('nqadmin::package.index.post')
            ->middleware('permission:package_create');

        $router->get('edit/{id}','PackageController@getEdit')
            ->name('nqadmin::package.edit.get')
            ->middleware('permission:package_edit');

        $router->post('edit/{id}','PackageController@postEdit')
            ->name('nqadmin::packet.edit.post')
            ->middleware('permission:package_edit');

        $router->get('delete/{id}','PackageController@getDelete')
            ->name('nqadmin::package.delete.get')
            ->middleware('permission:package_delete');

    });
});