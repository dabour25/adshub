<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if(!$user||$user->user_status!='admin'){
            return redirect('/');
        }
        return $next($request);
    }
}
