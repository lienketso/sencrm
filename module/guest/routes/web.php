<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>''],function(Router $router){
    $router->get('dang-ky','GuestController@getIndex')
        ->name('guest::dangky.get');
    $router->post('dang-ky','GuestController@postRegister')
        ->name('guest::dangky.post');
});