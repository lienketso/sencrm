<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 10:38
 */

namespace Mail\Providers;

use Illuminate\Support\ServiceProvider;
use Setting\Repositories\SettingRepository;
use Config;

class ModuleProvider extends ServiceProvider
{
    public function boot(SettingRepository $settingRepository)
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'nqadmin-mail');

        $setting = $settingRepository->getAllSetting();
        Config::set('mail.driver',isset($setting['mail_driver'])? $setting['mail_driver'] : '');
        Config::set('mail.host',isset($setting['mail_host']) ? $setting['mail_host'] : '');
        Config::set('mail.port',isset($setting['mail_port']) ? $setting['mail_port'] : '');
        Config::set('mail.username',isset($setting['mail_username']) ? $setting['mail_username'] : '');
        Config::set('mail.password',isset($setting['mail_password']) ? $setting['mail_password'] : '');
        Config::set('mail.encryption',isset($setting['mail_encrypt']) ? $setting['mail_encrypt'] : '');
    }

    public function register()
    {
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
        $this->app->register(InstallModuleProvider::class);
    }
}