<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 11:22 AM
 */

namespace Transaction\Providers;

use Illuminate\Support\ServiceProvider;
use Transaction\Hook\TransactionHook;

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
       add_action('nqadmin-register-menu', [TransactionHook::class, 'handle'], 40);
    }
}