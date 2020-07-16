<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/9/2018
 * Time: 3:41 PM
 */

namespace History\Providers;

use Illuminate\Support\ServiceProvider;
use History\Hook\HistoryHook;

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
       // add_action('nqadmin-register-menu', [HistoryHook::class, 'handle'], 20);
    }
}