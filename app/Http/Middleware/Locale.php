<?php

namespace App\Http\Middleware;

use Closure;
use Lang;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = \Session::get('lang', config('app.locale'));
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config

        Lang::setLocale($language);
        return $next($request);
    }
}
