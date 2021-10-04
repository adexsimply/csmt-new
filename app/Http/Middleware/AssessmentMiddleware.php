<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AssessmentMiddleware
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
        if(Auth::user()->hasPermissionTo('view report')){
            return $next($request);
        }

        return redirect('401');
    }
}
