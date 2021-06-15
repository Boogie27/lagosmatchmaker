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


    







    public function edit_detail_info_ajax(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'age' => 'required',
                'i_am' => 'required',
                'display_name' => 'required|max:50',
                'location' => 'required',
                'date_of_birth' => 'required',
                'religion' => 'required',
                'looking_for' => 'required',
                'marital_status' => 'required',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $id = $request->user_id;
                $user =  $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->age = $request->age;
                    $user->location = strtolower($request->location);
                    $user->genotype = $request->genotype;
                    $user->religion = strtolower($request->religion);
                    $user->looking_for = $request->looking_for;
                    $user->date_of_birth = $request->date_of_birth;
                    $user->marital_status = strtolower($request->marital_status);
                    $user->display_name = strtolower($request->display_name);
                    if($user->save())
                    {
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }






    public function ajax_get_detail_info(Request $request)
    {
        if($request->ajax())
        {
            $user = User::where('id', $request->user_id)->first(); //get user detail

            $gender = $user->gender == 'male' ? 'man' : 'woman'; // gender

            $display_name = $user->display_name ? $user->display_name : $user->user_name; //user name

            return view('admin.common.ajax-edit-detail-info', compact('user', 'gender', 'display_name'));
        }
        return response()->json(['data' => true]);
    }









    public function ajax_edit_about_me(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'about' => 'required|min:20|max:1000',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $id = $request->user_id;
                $user =  $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->about = $request->about;
                    if($user->save())
                    {
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    







    public function  ajax_edit_looking_for(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'looking_for_detail' => 'required|min:10|max:1000',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $id = $request->user_id;
                $user =  $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->looking_for_detail = $request->looking_for_detail;
                    if($user->save())
                    {
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }








    public function  ajax_edit_life_style(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'drinking' => 'required',
                'smoking' => 'required',
                'interest' => 'required|max:150',
                'language' => 'required|max:150',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $id = $request->user_id;
                $user =  $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->drinking = $request->drinking;
                    $user->smoking = $request->smoking;
                    $user->interest = $request->interest;
                    $user->language = $request->language;

                    if($user->save())
                    {
                        $data = true;
                    }
                }
            }

        }
        return response()->json(['data' => true]);
    }
    





    public function ajax_get_life_style(Request $request)
    {
        if($request->ajax())
        {
            $user = User::where('id', $request->user_id)->first(); //get user detail
            return view('admin.common.ajax-get-lifestyle', compact('user'));
        }
        return response()->json(['data' => true]);
    }








    public function  ajax_edit_physical_info(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'height' => 'required',
                'weight' => 'required',
                'body_type' => 'required',
                'ethnicity' => 'required',
                'hair_color' => 'required|max:150',
                'eye_color' => 'required|max:150',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $id = $request->user_id;
                $user =  $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->height = $request->height;
                    $user->weight = $request->weight;
                    $user->body_type = $request->body_type;
                    $user->ethnicity = $request->ethnicity;
                    $user->hair_color = $request->hair_color;
                    $user->eye_color = $request->eye_color;

                    if($user->save())
                    {
                        $data = true;
                    }
                }
            }

        }
        return response()->json(['data' => true]);
    }
    







    public function ajax_get_physical_info(Request $request)
    {
        if($request->ajax())
        {
            $user = User::where('id', $request->user_id)->first(); //get user detail
            return view('admin.common.ajax-get-physical-info', compact('user'));
        }
        return response()->json(['data' => true]);
    }


 



    // end
}
