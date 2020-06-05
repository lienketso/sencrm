<?php


namespace Members\Providers;


use Illuminate\Support\ServiceProvider;
use Users\Http\Middleware\CheckCourseOwner;

class MiddlewareProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('check-course-owner', CheckCourseOwner::class);
    }
}