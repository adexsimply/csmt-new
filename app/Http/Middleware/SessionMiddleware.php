<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SessionMiddleware
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
        if(Auth::user()->hasPermissionTo('view session')){
            return $next($request);
        }

        return redirect('401');
    }
}
