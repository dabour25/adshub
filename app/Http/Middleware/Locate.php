<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Locate
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
            if(Session::has('lang'))
            	$segment=Session::get('lang');
            else
            	$segment='en';
            app()->setLocale($segment);

        return $next($request);
    }
}
