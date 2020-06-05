<?php


namespace Members\Providers;

use Illuminate\Support\ServiceProvider;
use Members\Hook\MembersHook;

class HookProvider extends ServiceProvider
{
    public function boot(){
        $this->app->booted(function (){
            $this->booted();
        });
    }

    public function register(){

    }

    private function booted()
    {
        add_action('nqadmin-register-menu', [MembersHook::class, 'handle'], 2);
    }

}