<?php


namespace Package\Providers;


use Illuminate\Support\ServiceProvider;
use Package\Hook\PackageHook;

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
        add_action('nqadmin-register-menu',[PackageHook::class,'hanlde'],15);
    }
}