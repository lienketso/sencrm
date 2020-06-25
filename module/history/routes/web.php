<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'history';

Route::group(['prefix'=>$adminRoute],function(Router $router) use ($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router){
        $router->get('index','HistoryController@getIndex')
            ->name('nqadmin::history.index.get');
        $router->get('view/{id}','HistoryController@getView')
            ->name('nqadmin::history.view.get');
    });
});
