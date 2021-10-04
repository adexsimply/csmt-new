<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ClassMiddleware
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
        if(Auth::user()->hasPermissionTo('view class')){
            return $next($request);
        } 

        return redirect('401');
    }
}
