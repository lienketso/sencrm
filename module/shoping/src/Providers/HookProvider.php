<?php


namespace Shoping\Providers;

use Illuminate\Support\ServiceProvider;
use Shoping\Hook\ShopingHook;

class HookProvider extends ServiceProvider
{
    public function boot(){
        $this->app->booted(function (){
            $this->booted();
        });
    }
    public function register(){

    }
    public function booted(){
        add_action('nqadmin-register-menu',[ShopingHook::class,'hanlde'],21);
    }
}