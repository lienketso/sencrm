<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/9/2018
 * Time: 3:35 PM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'product';


//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('index', 'ProductController@getIndex')
            ->name('nqadmin::product.index.get')
            ->middleware('permission:product_index');

        $router->get('create', 'ProductController@getCreate')
            ->name('nqadmin::product.create.get')
            ->middleware('permission:product_create');

        $router->post('create','ProductController@postCreate')
            ->name('nqadmin::product.post')
            ->middleware('permission:product_create');

        $router->get('edit/{id}', 'ProductController@getEdit')
            ->name('nqadmin::product.edit.get')
            ->middleware('permission:product_edit');

        $router->post('edit/{id}', 'ProductController@postEdit')
            ->name('nqadmin::product.edit.post')
            ->middleware('permission:product_edit');

        $router->get('delete/{id}', 'ProductController@getDelete')
            ->name('nqadmin::product.delete.get')
            ->middleware('permission:product_delete');


    });

});


