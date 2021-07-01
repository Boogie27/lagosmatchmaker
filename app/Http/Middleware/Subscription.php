<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Subscription
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
        $today = date('Y-m-d H:i:s');
        $user_subs = DB::table('user_subscriptions')->where('is_expired', 0)->where('end_date', '<', $today)->get();

        if(count($user_subs))
        {
            foreach($user_subs as $user_sub)
            {
                DB::table('user_subscriptions')->where('user_sub_id', $user_sub->user_sub_id)->update([
                        'is_expired' => 1,
                        'date_ended' => $today
                ]);
                DB::table('notifications')->insert([
                    'notification_from' => 'admin',
                    'notification_to' => $user_sub->user_id,
                    'type' => 'expired_subscription',
                    'link' => '/subscription',
                    'description' => 'Your monthly '.$user_sub->subscription_type.' subscription has expired, Please subscribe to continue dating. To subscribe, click here ',
                ]);
            }
        }
        return $next($request);
    }
}
