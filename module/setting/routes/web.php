<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:06 PM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'setting';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('site-setting', 'SettingController@getSiteSetting')
            ->name('nqadmin::setting.site.get')
            ->middleware('permission:setting');

        $router->post('site-setting', 'SettingController@postSetting')
            ->name('nqadmin::setting.site.post')
            ->middleware('permission:setting');

        $router->get('funfact-setting', 'SettingController@getFunfactSetting')
            ->name('nqadmin::setting.funfact.get')
            ->middleware('permission:setting');

        $router->get('paypal-setting', 'SettingController@getPaymentSetting')
            ->name('nqadmin::setting.payment.get')
            ->middleware('permission:setting');

        $router->get('content-setting', 'SettingController@getContentSetting')
            ->name('nqadmin::setting.content.get')
            ->middleware('permission:setting');

        $router->get('mail', 'SettingController@getMailSetting')
            ->name('nqadmin::setting.mail.get')
            ->middleware('permission:setting');

        $router->post('mail', 'SettingController@postMailSetting')
            ->name('nqadmin::setting.mail.post')
            ->middleware('permission:setting');
    });
});