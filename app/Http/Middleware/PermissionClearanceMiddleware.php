<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class PermissionClearanceMiddleware
{
   
    public function handle($request, Closure $next){  

        if (Auth::user()->hasRole('admin')) {
            abort(404);
            return $next($request);
        }

        else if(Auth::user()->hasRole('user')) {

            if ($request->is('posts/create'))
            {
                if (!Auth::user()->hasPermissionTo('create post'))
                {
                   abort('404');
                } 
                else {
                   return $next($request);
                }
            }

            else if ($request->is('posts'))
            {
                if (!Auth::user()->hasPermissionTo('view post'))
                {
                   abort('404');
                } 
                else {
                   return $next($request);
                }
            }

            else if ($request->is('roles')) {
                return redirect('401');
            }

            else
                abort('404');
        }

       return $next($request);

    }


}
