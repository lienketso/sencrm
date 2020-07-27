<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 11:10 AM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'transaction';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('index', 'TransactionController@getIndex')
            ->name('nqadmin::transaction.index.get')
            ->middleware('permission:transaction_index');
        $router->get('order/{id}','TransactionController@getOrder')
            ->name('nqadmin::transaction.order.get')
            ->middleware('permission:transaction_order');
        $router->get('status/{id}','TransactionController@getStatus')
            ->name('nqadmin::transaction.status.get')
            ->middleware('permission:transaction_status');
    });


});