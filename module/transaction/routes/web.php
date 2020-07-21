<?php

$adminRoute = config('base.admin_route');
$moduleRoute = 'transaction';

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::group(['prefix'=>$adminRoute],function (Router $router) use ($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router){
        $router->get('index','TransactionController@getIndex')
            ->name('nqadmin::transaction.index.get');
    });
});