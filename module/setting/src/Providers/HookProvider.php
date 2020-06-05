<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 12:00 PM
 */

namespace Setting\Providers;

use Illuminate\Support\ServiceProvider;
use Setting\Hook\SettingHook;

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

    private function booted()
    {
        add_action('nqadmin-register-menu', [SettingHook::class, 'handle'], 100);
    }
}