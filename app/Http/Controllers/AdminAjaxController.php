<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Chat;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Session;
use Cookie;
use Validator;

class AdminAjaxController extends Controller
{
    public function ajax_suspend_member(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $user = User::where('id', $request->user_id)->first();
            if($user)
            {
                $is_suspend = $user->is_suspend ? 0 : 1;
                $suspend_date = $is_suspend ?  date('Y-m-d H:i:s') : null;

                $user->is_suspend = $is_suspend;
                $user->suspend_duration = $suspend_date;
                $user->is_active = 0;
                $user->save();
                if($is_suspend == 1){
                    return response()->json(['suspended' => true]);
                }else{
                    return response()->json(['unsuspended' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }









    public function ajax_approve_member(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $user = User::where('id', $request->user_id)->first();
            if($user)
            {
                $user->is_approved = 1;
                $user->save();
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
    





    public function ajax_deactivate_member(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $user = User::where('id', $request->user_id)->first();
            if($user)
            {
                $is_deactivated = $user->is_deactivated	 ? 0 : 1;
                $date_deactivated = $is_deactivated ?  date('Y-m-d H:i:s') : null;

                $user->is_deactivated = $is_deactivated;
                $user->date_deactivated = $date_deactivated;
                $user->is_active = 0;
                $user->save();
                if($is_deactivated == 1){
                    return response()->json(['deactivated' => true]);
                }else{
                    return response()->json(['activated' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }


    




    // end
}
