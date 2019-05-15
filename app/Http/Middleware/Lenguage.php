<?php

namespace AlaCartaYa\Http\Middleware;

use Closure;
use Session;
use Config;
use App;
class Lenguage
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
        if ($request->session()->has('my_locale')  ) {
            $locale = $request->session()->get('my_locale');
            App::setLocale($locale);
        }
        return $next($request);
    }
}
