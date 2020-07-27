<?php

$adminRoute = config('base.admin_route');
$moduleRoute = 'shoping';

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::group(['prefix'=>$adminRoute], function(Router $router) use ($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute], function (Router $router) {
        $router->get('index','ShopingController@getIndex')
            ->name('nqadmin::shoping.index.get')
            ->middleware('permission:shoping_index');
        $router->get('detail/{id}','ShopingController@getDetail')
            ->name('nqadmin::shoping.detail.get')
            ->middleware('permission:shoping_detail');
        $router->get('add/{id}','ShopingController@getAdd')
            ->name('nqadmin::shoping.add.get')
            ->middleware('permission:shoping_add');
        $router->get('update','ShopingController@getUpdate')
            ->name('nqadmin::shoping.update.get')
            ->middleware('permission:shoping_update');
        $router->get('del/{id}','ShopingController@getDel')
            ->name('nqadmin::shoping.del.get')
            ->middleware('permission:shoping_del');
        $router->get('order','ShopingController@postAdd')
            ->name('nqadmin::shoping.order.get')
            ->middleware('permission:shoping_order');
    });
});
