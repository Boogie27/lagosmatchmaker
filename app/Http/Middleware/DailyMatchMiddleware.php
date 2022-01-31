<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\User;
use App\Models\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DailyMatchMiddleware
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
        if(Session::has('user'))
        {
            $today = date('Y-m-d H:i:s');
            $daily_match = DB::table('daily_matches')->where('user_id', Auth::user('id'))->first();
            if($daily_match && $today >= $daily_match->match_expire)
            {
                DB::table('daily_matches')->where('id', $daily_match->id)->delete();
            }
        }
        return $next($request);
    }
}
