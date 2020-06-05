<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 10:41
 */

namespace Mail\Providers;

use Illuminate\Support\ServiceProvider;
use Mail\Hook\MailHook;
use Mail\Hook\MailSettingHook;

class HookProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $this->booted();
        });
    }

    public function register()
    {

    }

    public function booted()
    {
       // add_action('nqadmin-register-menu', [MailHook::class, 'handle'], 45);
        add_action('nqadmin-setting-register-menu', [MailSettingHook::class, 'handle'], 15);
    }
}