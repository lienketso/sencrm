<?php


namespace Transaction\Providers;


use Illuminate\Support\ServiceProvider;
use Transaction\Hook\TransactionHook;

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
        add_action('nqadmin-register-menu',[TransactionHook::class,'hanlde'],23);
    }

}