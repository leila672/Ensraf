<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class Schools
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
        if(Auth::user()->user_type == 'school'){
            return $next($request);
        }elseif(Auth::user()->user_type == 'staff'){
            return redirect()->route('admin.home');
        }else{
            return abort(403);
        }
    }
}




