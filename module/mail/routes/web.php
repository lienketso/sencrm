<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 10:37
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'mail';
$settingRoute = 'setting';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('index', 'MailController@getIndex')
            ->name('nqadmin::mail.index.get')
            ->middleware('permission:mail_index');

        $router->get('create', 'MailController@getCreate')
            ->name('nqadmin::mail.create.get')
            ->middleware('permission:mail_create');

        $router->post('create', 'MailController@postCreate')
            ->name('nqadmin::mail.create.post')
            ->middleware('permission:mail_create');

        $router->get('edit/{id}', 'MailController@getEdit')
            ->name('nqadmin::mail.edit.get')
            ->middleware('permission:mail_edit');

        $router->post('edit/{id}', 'MailController@postEdit')
            ->name('nqadmin::mail.edit.post')
            ->middleware('permission:mail_edit');

        $router->get('delete/{id}', 'MailController@getDelete')
            ->name('nqadmin::mail.delete.get')
            ->middleware('permission:mail_delete');
    });
});

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $settingRoute) {
    $router->group(['prefix' => $settingRoute], function (Router $router) use ($adminRoute, $settingRoute) {

        $router->get('mail', 'SettingController@getMailSetting')
            ->name('nqadmin::setting.mail.get')
            ->middleware('permission:setting');

        $router->post('mail', 'SettingController@postMailSetting')
            ->name('nqadmin::setting.mail.post')
            ->middleware('permission:setting');
    });
});