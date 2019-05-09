<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserIsAdmin
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
        if(auth()->check()){
            if(in_array("administrator",auth()->user()->roles->pluck('name')->toArray())){
                return $next($request);
            }
        }

        abort(403);
    }
}
