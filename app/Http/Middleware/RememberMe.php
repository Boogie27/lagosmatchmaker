<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Session;
use App\Models\User;
use App\Models\Auth;
use Illuminate\Http\Request;

class RememberMe
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

        if(!Session::has('user') && Cookie::has('lagosmatchmaker_remember_me'))
        {
            if(Auth::remember_login())
            {
                return redirect('/');
            }
        }
        
        return $next($request);
    }
}
