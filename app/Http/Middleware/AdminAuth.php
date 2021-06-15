<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;

class AdminAuth
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
        if(!Session::has('admin'))
        {
            if(!Admin::is_loggedin())
            {
                Session::put('old_url', current_url());
               return redirect('/admin/login');
            }
        }
        return $next($request);
    }
}
