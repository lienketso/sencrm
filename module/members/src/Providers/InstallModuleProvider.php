<?php


namespace Members\Providers;


use Illuminate\Support\ServiceProvider;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Members';

    public function boot(){
        app()->booted(function () {
            $this->booted();
        });
    }
    public function register()
    {

    }
    public function booted(){

    }

}