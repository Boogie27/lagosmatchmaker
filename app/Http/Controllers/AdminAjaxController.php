<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Chat;
use App\Models\Admin;
use App\Models\Image;
use App\Models\ContactUs;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



use App\Mail\ApproveUserMail;
use App\Mail\NewsletterMailer;
use App\Jobs\SendNewsletterJob;

use Mail;
use Session;
use Cookie;
use Validator;

class AdminAjaxController extends Controller
{


    
    public function ajax_logout_admin(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            if(Admin::logout())
            {
                $data = url('/admin/login');
            }
        }
        return response()->json(['data' => $data]);
    }





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
            $user_detail = $user;
            if($user)
            {
                $data = true;
                $this->send_approved_notification($user);
                $user->is_approved = 1;
                $user->save();
              
                if(settings()->approved_profile_mail)
                {
                    Mail::to($user_detail->email)->send(new ApproveUserMail());
                }
            }
        }
        return response()->json(['data' => $data]);
    }









    



    public function send_approved_notification($user)
    {
        if($user)
        {
            $settings = DB::table('settings')->where('id', 1)->first();

            DB::table('notifications')->insert([
                'notification_from' => 'admin',
                'notification_to' => $user->id,
                'title' => $user->user_name,
                'type' => 'approved',
                'description' => $settings->complete_profile_alert
            ]);
        }
    }








    public function ajax_mass_approve_members(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            if(!count($request->stored_id))
            {
                return response()->json(['empty' => true]);
            }

            foreach($request->stored_id as $user_id)
            {
                $user = User::where('id', $user_id)->first();
                $user_detail = $user;
                if($user)
                {
                    $data = true;
                    $this->send_approved_notification($user);
                    $user->is_approved = 1;
                    $user->save();
                  
                    if(settings()->approved_profile_mail)
                    {
                        Mail::to($user_detail->email)->send(new ApproveUserMail());
                    }
                }
            }
            
        }
        return response()->json(['data' => $data]);
    }

    








    public function ajax_mass_unapprove_members(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
            if(!count($request->stored_id))
            {
                return response()->json(['empty' => true]);
            }

            foreach($request->stored_id as $user_id)
            {
                $user = User::where('id', $user_id)->first();
                $user_detail = $user;
                if($user)
                {
                    $data = true;
                    $this->send_approved_notification($user);
                    $user->is_approved = 0;
                    $user->save();
                }
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
                'display_name' => 'max:50',
                'complexion' => 'max:50',
                'career' => 'max:100',
                'university' => 'max:100',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                if($request->phone)
                {
                    if(strlen($request->phone) < 11)
                    {
                        return response()->json(['error' => ['phone' => '*Minimum of 11 characters!']]);
                    }
                    if(strlen($request->phone) > 20)
                    {
                        return response()->json(['error' => ['phone' => '*Maximum of 20 characters!']]);
                    }
                    if(!is_numeric($request->phone))
                    {
                        return response()->json(['error' => ['phone' => 'Wrong phone number format!']]);
                    }
                }

                $id = $request->user_id;
                $user =  $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->age = $request->age ? $request->age : null;
                    $user->gender = $request->i_am ? $request->i_am : null;
                    $user->phone = $request->phone ? $request->phone : null;
                    $user->country = $request->country ? $request->country : null;
                    $user->HIV = $request->hiv ? strtoupper($request->hiv) : null;
                    $user->complexion = $request->complexion ? $request->complexion : null;
                    $user->career = $request->career ? $request->career : null;
                    $user->education = $request->university ? $request->university : null;
                    $user->location = $request->location ? strtolower($request->location) : null;
                    $user->genotype = $request->genotype ? $request->genotype : null;
                    $user->religion = $request->religion ? strtolower($request->religion) : null;
                    $user->looking_for = $request->looking_for ? $request->looking_for : null; 
                    $user->marital_status = $request->marital_status ? strtolower($request->marital_status) : null;
                    $user->display_name = $request->display_name ? strtolower($request->display_name) : null;
                    $user->state_of_origin = $request->state_of_origin ? strtolower($request->state_of_origin) : null;
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
                'interest' => 'max:150',
                'language' => 'max:150',
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
            $id = $request->user_id;
            $user =  $user = User::where('id', $id)->first(); //get user detail
            if($user)
            {
                $user->height = $request->height;
                $user->weight = $request->weight;
                $user->body_type = $request->body_type;
                $user->ethnicity = $request->ethnicity;

                if($user->save())
                {
                    $data = true;
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






    public function ajax_edit_genotype(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'genotype' => 'required|max:5',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $genotype = strtoupper($request->genotype);
                $check = DB::table('genotypes')->where('id', $request->genotype_id)->where('genotype', $genotype)->first();
                if(!$check)
                {
                    $second_check = DB::table('genotypes')->where('genotype', $genotype)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['genotype' => '*Genotype already exists']]);
                    }
                }

                DB::table('genotypes')->where('id', $request->genotype_id)->update([
                              'genotype' => $genotype
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
    








    
    public function ajax_delete_genotype(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('genotypes')->where('id', $request->genotype_id)->first();
            if($check)
            {
                $delete = DB::table('genotypes')->where('id', $request->genotype_id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }








    public function ajax_add_genotype(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'genotype' => 'required|max:5',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $genotype = strtoupper($request->genotype);
                $check = DB::table('genotypes')->where('genotype', $genotype)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['genotype' => '*Genotype already exists']]);
                }

                $create = DB::table('genotypes')->insert([
                              'genotype' => $genotype
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Genotype added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    









    public function ajax_feature_genotype(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $genotype = DB::table('genotypes')->where('id', $request->genotype_id)->first();
            if($genotype)
            {
                $is_featured = $genotype->is_featured ? 0 : 1;
                $update = DB::table('genotypes')->where('id', $request->genotype_id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }

    








    
    public function ajax_edit_state(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'state' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $state = strtoupper($request->state);
                $check = DB::table('states')->where('id', $request->id)->where('state', $state)->first();
                if(!$check)
                {
                    $second_check = DB::table('states')->where('state', $state)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['state' => '*State already exists']]);
                    }
                }

                DB::table('states')->where('id', $request->id)->update([
                              'state' => $state
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }







    
    public function ajax_delete_state(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('states')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('states')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }







    
    public function ajax_add_state(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'state' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $state = strtoupper($request->state);
                $check = DB::table('states')->where('state', $state)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['state' => '*State already exists']]);
                }

                $create = DB::table('states')->insert([
                              'state' => $state
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'State added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }







    
    public function ajax_feature_state(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('states')->where('id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->is_featured ? 0 : 1;
                $update = DB::table('states')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }







    public function ajax_edit_marital_status(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'marital_status' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('marital_status')->where('id', $request->id)->where('marital_status', $request->marital_status)->first();
                if(!$check)
                {
                    $second_check = DB::table('marital_status')->where('marital_status', $request->marital_status)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['marital_status' => '*Marital status already exists']]);
                    }
                }

                DB::table('marital_status')->where('id', $request->id)->update([
                              'marital_status' => $request->marital_status
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }









    public function ajax_feature_marital_status(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('marital_status')->where('id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->is_featured ? 0 : 1;
                $update = DB::table('marital_status')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }





    



    public function ajax_add_martital_status(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'marital_status' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('marital_status')->where('marital_status', $request->marital_status)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['marital_status' => '*Marital status already exists']]);
                }

                $create = DB::table('marital_status')->insert([
                              'marital_status' => $request->marital_status
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Marital status added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }







    
    public function ajax_delete_marital_status(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('marital_status')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('marital_status')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }









    public function ajax_edit_drinking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'drinking' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('drinking')->where('id', $request->id)->where('title', $request->drinking)->first();
                if(!$check)
                {
                    $second_check = DB::table('drinking')->where('title', $request->drinking)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['drinking' => '*Drinking already exists']]);
                    }
                }

                DB::table('drinking')->where('id', $request->id)->update([
                              'title' => $request->drinking
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }




    

    public function ajax_delete_drinking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('drinking')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('drinking')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }


    





    public function ajax_add_drinking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'drinking' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('drinking')->where('title', $request->drinking)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['drinking' => '*Drinking already exists']]);
                }

                $create = DB::table('drinking')->insert([
                              'title' => $request->drinking
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Drinking option added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }


    




    public function ajax_feature_drinking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('drinking')->where('id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->is_featured ? 0 : 1;
                $update = DB::table('drinking')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    







    public function ajax_edit_smoking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'smoking' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('smoking')->where('id', $request->id)->where('title', $request->smoking)->first();
                if(!$check)
                {
                    $second_check = DB::table('smoking')->where('title', $request->smoking)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['smoking' => '*Smoking option already exists']]);
                    }
                }

                DB::table('smoking')->where('id', $request->id)->update([
                              'title' => $request->smoking
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }









    
    public function ajax_delete_smoking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('smoking')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('smoking')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }


    





    public function ajax_add_smoking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'smoking' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('smoking')->where('title', $request->smoking)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['smoking' => '*Smoking option already exists']]);
                }

                $create = DB::table('smoking')->insert([
                              'title' => $request->smoking
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Smoking option added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    






    public function ajax_feature_smoking(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('smoking')->where('id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->is_featured ? 0 : 1;
                $update = DB::table('smoking')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    







    public function ajax_edit_body_type(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'body_type' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('body_type')->where('id', $request->id)->where('body_type', $request->body_type)->first();
                if(!$check)
                {
                    $second_check = DB::table('body_type')->where('body_type', $request->body_type)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['body_type' => '*Body type option already exists']]);
                    }
                }

                DB::table('body_type')->where('id', $request->id)->update([
                              'body_type' => $request->body_type
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }



    









    public function ajax_delete_body_type(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('body_type')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('body_type')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    





    public function ajax_add_body_type(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'body_type' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('body_type')->where('body_type', $request->body_type)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['body_type' => '*Body type already exists']]);
                }

                $create = DB::table('body_type')->insert([
                              'body_type' => $request->body_type
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Body type option added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    






    public function ajax_feature_body_type(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $body_type = DB::table('body_type')->where('id', $request->id)->first();
            if($body_type)
            {
                $is_featured = $body_type->is_featured ? 0 : 1;
                $update = DB::table('body_type')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    
    







    public function ajax_edit_height(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'height' => 'required|max:50',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('height')->where('id', $request->id)->where('height', $request->height)->first();
                if(!$check)
                {
                    $second_check = DB::table('height')->where('height', $request->height)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['height' => '*Height already exists']]);
                    }
                }

                DB::table('height')->where('id', $request->id)->update([
                              'height' => $request->height
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }



    









    public function ajax_delete_height(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('height')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('height')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    





    public function ajax_add_height(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'height' => 'required|max:20',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('height')->where('height', $request->height)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['height' => '*Height already exists']]);
                }

                $create = DB::table('height')->insert([
                              'height' => $request->height
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Height option added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    






    public function ajax_feature_height(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('height')->where('id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->is_featured ? 0 : 1;
                $update = DB::table('height')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    
    






    public function ajax_edit_weight(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'weight' => 'required|max:10',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('weight')->where('id', $request->id)->where('weight', $request->weight)->first();
                if(!$check)
                {
                    $second_check = DB::table('weight')->where('weight', $request->weight)->get();
                    if(count($second_check))
                    {
                        return response()->json(['error' => ['weight' => '*Weight already exists']]);
                    }
                }

                DB::table('weight')->where('id', $request->id)->update([
                              'weight' => $request->weight
                        ]);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }



    









    public function ajax_delete_weight(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('weight')->where('id', $request->id)->first();
            if($check)
            {
                $delete = DB::table('weight')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    





    public function ajax_add_weight(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'weight' => 'required|max:20',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('weight')->where('weight', $request->weight)->get();
                if(count($check))
                {
                    return response()->json(['error' => ['weight' => '*Weight already exists']]);
                }

                $create = DB::table('weight')->insert([
                              'weight' => $request->weight
                        ]);
                if($create)
                {
                    $data = true;
                    Session::flash('success', 'Weight option added successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    






    public function ajax_feature_weight(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('weight')->where('id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->is_featured ? 0 : 1;
                $update = DB::table('weight')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }








    public function ajax_feature_subscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('subscriptions')->where('sub_id', $request->id)->first();
            if($check)
            {
                $is_featured = $check->sub_is_featured ? 0 : 1;
                $update = DB::table('subscriptions')->where('sub_id', $request->id)->update([
                        'sub_is_featured' => $is_featured
                ]);
                if($is_featured)
                {
                    return response()->json(['featured' => true]);
                }else{
                    return response()->json(['unfeatured' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    








    public function ajax_end_subscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $today = date('Y-m-d H:i:s');
            
            $check = DB::table('user_subscriptions')->where('user_sub_id', $request->id)->first();
            if($check && $today < $check->end_date)
            {
               
                $is_expired = $check->is_expired ? 0 : 1;
                $end_date = $is_expired ? $today : null;

                DB::table('user_subscriptions')->where('user_sub_id', $request->id)->update([
                        'is_expired' => $is_expired,
                        'date_ended' => $end_date
                ]);

                if($is_expired)
                {
                    DB::table('notifications')->insert([
                        'notification_from' => 'admin',
                        'notification_to' => $check->user_id,
                        'type' => 'expired_subscription',
                        'link' => '/subscription',
                        'description' => 'Your monthly '.$check->subscription_type.' subscription has expired, Please subscribe to continue dating. To subscribe, click here ',
                    ]);

                    return response()->json(['expired' => true]);
                }else{
                    return response()->json(['active' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    
    







    public function ajax_contact_us_seen(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = ContactUs::where('id', $request->contact_id)->first();
            if($check)
            {
                $check->is_seen = 1;
                $check->save();
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
    






    public function ajax_contact_us_delete(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = ContactUs::where('id', $request->contact_id)->first();
            if($check)
            {
                $delete = ContactUs::where('id', $request->contact_id)->delete();
                if($delete)
                {
                    $data = url('/admin/contact');
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    








    public function ajax_report_seen(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('user_reports')->where('report_id', $request->report_id)->first();
            if($check)
            {
                $update = DB::table('user_reports')->where('report_id', $request->report_id)->update([
                            'is_seen' => 1
                        ]);
                if($update)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    







    public function ajax_report_delete(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('user_reports')->where('report_id', $request->report_id)->first();
            if($check)
            {
                $delete = DB::table('user_reports')->where('report_id', $request->report_id)->delete();
                if($delete)
                {
                    $data = url('/admin/reports');
                    if($request->report_page)
                    {
                        Session::flash('success', $request->content.' report deleted successfull');
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }




    





    public function ajax_get_notification_count(Request $request)
    {
        if($request->ajax())
        {
            $data = false;

            $count = DB::table('notifications')->where('notification_to', 'admin')->where('is_seen', 0)->get();
            if(count($count))
            {
                $data = count($count);
            }
            return response()->json(['data' => $data]);
        }
    }    
    








    public function ajax_get_navi_notification(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(Admin::is_loggedin())
            {
                $notifications = DB::table('notifications')->where('notification_to', 'admin')->where('is_seen', 0)->orderBy('not_id', 'DESC')->limit(20)->get();
                if($notifications)
                {
                    return view('admin.common.ajax-notification', compact('notifications'));
                }
            }
            return response()->json(['data' => $data]);
        }
    } 








    public function ajax_delete_notification(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $check = DB::table('notifications')->where('not_id', $request->notification_id)->first();
            if($check)
            {
                $delete = DB::table('notifications')->where('not_id', $request->notification_id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }




    
    


    public function ajax_seen_notification(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(Admin::is_loggedin())
            {
                $check = DB::table('notifications')->where('not_id', $request->notification_id)->first();
                if($check)
                {
                    $update = DB::table('notifications')->where('not_id', $request->notification_id)->update([
                                       'is_seen' => 1
                                ]);
                    if($update)
                    {
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }

    






    public function ajax_clear_all_notification(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(Admin::is_loggedin())
            {
                $check = DB::table('notifications')->where('notification_to', 'admin')->get();
                if(count($check))
                {
                    $error = false;
                    foreach($check as $notification)
                    {
                        $delete = DB::table('notifications')->where('not_id', $notification->not_id)->delete();
                        if(!$delete)
                        {
                            $error = true;
                        }
                    }
                    if(!$error)
                    {
                        $data = true;
                    }
                }else{
                    return response()->json(['empty' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }









    
    
    public function ajax_add_slider(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(Image::exists('image'))
            {
                $file = Image::files('image');
                $image = new Image();

                $fileName = Image::name('image', 'slider');
                $slider = 'web/images/banner/'.$fileName;
                $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 10000000,'file_destination' => 'web/images/banner/' ]);
                
                if(!$image->passed())
                {
                    return response()->json(['error' => ['image' => $image->error()]]);
                }
                if($image->passed())
                {
                    $create = DB::table('banners')->insert([
                        'banner' => $slider
                    ]);
                    if($create)
                    {
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    





    
    public function ajax_get_slider(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $sliders = DB::table('banners')->get(); //get all banners
            if($sliders)
            {
                return view('admin.common.ajax-get-slider', compact('sliders'));
            }
        }
        return response()->json(['data' => $data]);
    }







    public function ajax_delete_slider(Request $request)
    {
        if($request->ajax())
        {
            $data = true;
            $banner = DB::table('banners')->where('id', $request->banner_id)->first(); //get banner
            if($banner)
            {
                $banner_img = $banner->banner;
                $delete = DB::table('banners')->where('id', $request->banner_id)->delete();
                if($delete)
                {
                    Image::remove($banner_img);
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }










    public function ajax_update_slider(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $banner = DB::table('banners')->where('id', $request->banner_id)->first(); //get banner
            if(!$banner)
            {
                return response()->json(['data' => $data]);
            }

            if(Image::exists('image'))
            {
                $file = Image::files('image');
                $image = new Image();

                $fileName = Image::name('image', 'slider');
                $slider = 'web/images/banner/'.$fileName;
                $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 10000000,'file_destination' => 'web/images/banner/' ]);
                
                if(!$image->passed())
                {
                    return response()->json(['error' => ['image' => $image->error()]]);
                }
                if($image->passed())
                {
                    $banner_img = $banner->banner;
                    $update = DB::table('banners')->where('id', $request->banner_id)->update([
                        'banner' => $slider
                    ]);
                    if($update)
                    {
                        Image::remove($banner_img);
                        $data = asset($slider);
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }

    









    public function ajax_feature_slider(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $banner = DB::table('banners')->where('id', $request->banner_id)->first(); //get banner
            if($banner)
            {
                $is_featured = $banner->is_featured ? 0 : 1;
                $update = DB::table('banners')->where('id', $request->banner_id)->update([
                        'is_featured' => $is_featured
                ]);
                if($update)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }



    




    public function ajax_edit_subscription_description(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'description' => 'required|max:500',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $manuals = DB::table('settings')->where('id', 1)->first();
                if($manuals)
                {
                    $manual_subscription = json_decode($manuals->manual_subscription, true);
                    if(count($manual_subscription['descriptions']))
                    {
                        $descriptions = $manual_subscription['descriptions'];
                        if(array_key_exists($request->key, $descriptions))
                        {
                            $descriptions[$request->key] = $request->description;
                            $manual_subscription['descriptions'] = $descriptions;

                            $store_items = json_encode($manual_subscription);
                            DB::table('settings')->where('id', 1)->update([
                                'manual_subscription' => $store_items
                            ]);
                            $data = true;
                        }
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }


    






    public function ajax_delete_subscription_description(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $manuals = DB::table('settings')->where('id', 1)->first();
                if($manuals)
                {
                    $manual_subscription = json_decode($manuals->manual_subscription, true);
                    if(count($manual_subscription['descriptions']))
                    {
                        $descriptions = $manual_subscription['descriptions'];
                        if(array_key_exists($request->key, $descriptions))
                        {
                            unset($descriptions[$request->key]);
                            $manual_subscription['descriptions'] = $descriptions;

                            $store_items = json_encode($manual_subscription);
                            DB::table('settings')->where('id', 1)->update([
                                'manual_subscription' => $store_items
                            ]);
                            $data = true;
                        }
                    }
                }
        }
        return response()->json(['data' => $data]);
    }

    










    public function ajax_delete_subscription_bank_icon(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $manuals = DB::table('settings')->where('id', 1)->first();
            if($manuals)
            {
                $manual_subscription = json_decode($manuals->manual_subscription, true);
                if(count($manual_subscription['image']))
                {
                    $image = $manual_subscription['image'];
                    if(array_key_exists($request->key, $image))
                    {
                        Image::remove($image[$request->key]);
                        unset($image[$request->key]);
                        $manual_subscription['image'] = $image;

                        $store_items = json_encode($manual_subscription);
                        DB::table('settings')->where('id', 1)->update([
                            'manual_subscription' => $store_items
                        ]);
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    










    public function ajax_add_subscription_bank_icon(Request $request)
    {
        if($request->ajax())
        {
            if(Image::exists('image'))
            {
                $file = Image::files('image');
                $image = new Image();

                $fileName = Image::name('image', 'bank_icon');
                $icon = 'web/images/icons/'.$fileName;
                $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 10000000,'file_destination' => 'web/images/icons/' ]);
                
                if(!$image->passed())
                {
                    return response()->json(['error' => ['image' => $image->error()]]);
                }

                if($image->passed())
                {
                    $manuals = DB::table('settings')->where('id', 1)->first();
                    $manual_subscription = json_decode($manuals->manual_subscription, true);

                    array_push($manual_subscription['image'], $icon);
           
                    $store_items = json_encode($manual_subscription);
                    DB::table('settings')->where('id', 1)->update([
                        'manual_subscription' => $store_items
                    ]);

                    $images = $this->manual_subscription_icons();

                    return view('admin.common.ajax-bank-icons', compact('images'));
                }
            }
        }
        return response()->json(['alert_error' => true]);
    }

    






    public function manual_subscription_icons()
    {
        $images = null;
        $descriptions = null;
        $manuals = DB::table('settings')->where('id', 1)->first();
        if($manuals)
        {
            $manual_subscription = json_decode($manuals->manual_subscription, true);
            if(count($manual_subscription['image']))
            {
                $images = $manual_subscription['image'];
            }
        }
        
        return $images;
    }








    public function ajax_add_user_subscription(Request $request)
    {
        $data = false;
        if($request->ajax())
        {
             $validator = Validator::make($request->all(), [
                'type' => 'required',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => ['all' => '*All fields are required']]);
            }

            if($validator->passes())
            {
                $subscription = DB::table('subscriptions')->where('type', $request->type)->first();
                if($subscription)
                {
                    $old_sub = DB::table('user_subscriptions')->where('user_id', $request->user_id)->where('is_expired', 0)->first();
                    if($old_sub)
                    {
                        DB::table('user_subscriptions')->where('user_id', $request->user_id)->where('is_expired', 0)->update([
                                'is_expired' => 1,
                                'date_ended' => date('Y-m-d H:i:s')
                        ]);
                    }
                    
                    $reference = uniqid();
                    $end_date = date('Y-m-d H:i:s', strtotime('+'.$subscription->duration));

                    $create = DB::table('user_subscriptions')->insert([
                                'reference' => $reference,
                                'user_id' => $request->user_id,
                                'subscription_id' => $subscription->sub_id,
                                'duration' => $subscription->duration,
                                'amount' => $request->amount,
                                'subscription_type' => $subscription->type,
                                'start_date' => date('Y-m-d H:i:s'),
                                'end_date' => $end_date,
                            ]);
                    
                    if($create)
                    {
                        $user = User::where('id', $request->user_id)->first();
                        $user->membership_level = $subscription->type;
                        $user->save();

                        $data = true;
                        Session::flash('success', 'Subscription added successfully!');
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    










    
    public function ajax_delete_newsletter_subscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $newsletter = DB::table('newsletter_subscriptions')->where('id', $request->id)->first();
            if($newsletter)
            {
                $delete = DB::table('newsletter_subscriptions')->where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }










    
    public function ajax_all_newsletter_id(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if($request->state == 'false')
            {
                $data = true;
                Session::forget('all');
                Session::forget('newsletter');
            }

            if($request->state == 'true')
            {
                $store_id = null;
                $newsletters = DB::table('newsletter_subscriptions')->get();
                if($newsletters)
                {
                    foreach($newsletters as $newsletter)
                    {
                        $store_id[] = ['id' => $newsletter->id, 'email' => $newsletter->email];
                    }
                    
                    Session::put('all', true);
                    Session::put('newsletter', $store_id);
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }






    public function ajax_single_newsletter_email_id(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $is_present = false;

            if($request->state == 'false')
            {
                if(Session::has('newsletter'))
                {
                    $stored_ids = Session::get('newsletter');
                    foreach($stored_ids as $key => $stored_id)
                    {
                        if($request->id == $stored_id['id'])
                        {
                            unset($stored_ids[$key]);
                        }
                    }
                    Session::forget('all');
                    Session::put('newsletter', $stored_ids);
                    return response()->json(['removed' => true]);
                }
            }

            if($request->state == 'true')
            {
                if(Session::has('newsletter'))
                {
                    $stored_ids = Session::get('newsletter');
                    foreach($stored_ids as $key => $stored_id)
                    {
                        if($request->id == $stored_id['id'])
                        {
                            $is_present = true;
                        }
                    }
                }

                if($is_present == false)
                {
                    $stored_ids[] = ['id' => $request->id, 'email' => $request->email];
                    Session::put('newsletter', $stored_ids);
                }
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
    








    public function ajax_check_newsletter_mass_delete(Request $request)
    {
        if($request->ajax())
        {
           
            if(Session::has('newsletter'))
            {
                $stored_ids = Session::get('newsletter');
                foreach($stored_ids as $key => $stored_id)
                {
                    DB::table('newsletter_subscriptions')->where('id', $stored_id['id'])->delete();
                    unset($stored_ids[$key]);
                }

                Session::put('newsletter', $stored_ids);
                if(count($stored_ids) == 0)
                {
                    Session::forget('all');
                    Session::forget('newsletter');
                }

                $newsletters = DB::table('newsletter_subscriptions')->paginate(25);

                return view('admin.common.ajax-newsletter', compact('newsletters'));
            }
            
        }
        return response()->json(['error' => true]);
    }
    


    




    public function ajax_delete_news_letter(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $newsletter = Newsletter::where('id', $request->id)->first();
            if($newsletter)
            {
                $delete = Newsletter::where('id', $request->id)->delete();
                if($delete)
                {
                    $data = true;
                    if($request->edit)
                    {
                        $data = url('/admin/news-letter');
                        Session::flash('success', 'Newsletter deleted successfully!');
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    









    
    public function ajax_delete_mass_news_letter(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $is_save = false;
            $news_letters = $request->stored_id;
            if(count($news_letters))
            {
                foreach($news_letters as $news_letter)
                {
                    Newsletter::where('id', $news_letter)->delete();
                }
               
                if($request->newsletter)
                {
                    $is_save = true;
                    $newsletters = Newsletter::where('is_save', 0)->where('is_sent', 0)->paginate(25);
                }
                if($request->save)
                {
                    $newsletters = Newsletter::where('is_save', 1)->paginate(25);
                }
                
                if($request->sent)
                {
                    $newsletters = Newsletter::where('is_sent', 1)->paginate(25);
                }
            
                return view('admin.common.ajax-get-newsletters', compact('newsletters', 'is_save'));
            }
            
        }
        return response()->json(['data' => $data]);
    }










    public function ajax_save_newsletter(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $newsletter = Newsletter::where('id', $request->id)->first();
            if($newsletter)
            {
                $is_save = $newsletter->is_save ? 0 : 1;
                $update = Newsletter::where('id', $request->id)->update([
                        'is_save' => $is_save
                    ]);
                if($update)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    
    









    public function ajax_profile_upload_image(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if($request->image)
            {
                $encode_1 = explode(';', $request->image);
                $encode_2 = explode(',', $encode_1[1]);

                $image = base64_decode($encode_2[1]);
                $image_name = 'admins/images/profile_image/profile_image_'.time().'.png';
                
                if(file_put_contents($image_name, $image))
                {
                    $profile = Admin::where('id', Admin::admin('id'))->first();
                    if($profile && $profile->image)
                    {
                        Image::remove($profile->image);
                    }

                    if(!$profile)
                    {
                        Image::remove($image_name);
                    }else{
                        $profile->image = $image_name;
                        $profile->save();
                        
                        $sessionImage = Session::get('admin');
                        $sessionImage['image'] = $image_name;
                        Session::put('admin', $sessionImage);

                        $data = asset($image_name);
                    }
                }
            } 
        }
        return response()->json(['data' => $data]);
    }

    







    
    public function ajax_send_news_letter(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(!Session::has('newsletter'))
            {
                return response()->json(['error' => '*There are no subscribers selected']);
            }

            $subscribers = Session::get('newsletter');
            $newsletter = Newsletter::where('id', $request->newsletter_id)->first();
            if(!$newsletter)
            {
                return response()->json(['error' => '*Newsletter does not exist']);
            }

            if($newsletter)
            {
                foreach($subscribers as $subscriber)
                {
                    Mail::to($subscriber['email'])->send(new NewsletterMailer($newsletter));;
                }
                $data = true;
                Session::forget('all');
                Session::forget('newsletter');
            }
        }
        return response()->json(['data' => $data]);
    }









    public function ajax_delete_user_chat(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $chat = Chat::where('chat_id', $request->chat_id)->first();
            if($chat)
            {
                if($chat->type == 'image')
                {
                    Image::remove($chat->chat);
                }

                $delete = Chat::where('chat_id', $request->chat_id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }







    

    public function ajax_get_infinit_user_chat(Request $request)
    {
        if($request->ajax())
        {
            $take = 25;
            $data = false;
            $remender = 0;
            $count = count(Chat::where('chat_token', $request->chat_token)->get());
            $chat = Chat::where('chat_token', $request->chat_token);
            if($count)
            {
                if($count > $request->take)
                {
                    $skip = $count - $request->take;
                    $remender = $skip;
                    $chats = $chat->skip($skip)->take($take)->get();
                }
                if($count <= $request->take)
                {
                    $chats = $chat->limit($request->remender)->get();
                }
            }
            $data  = $this->get_user_chat($chats, $request->user_id);
        }
        return response()->json(['data' => $data, 'remender' => $remender]);
    }



public function get_user_chat($chats, $user_id)
{
    $value = '';
    if(count($chats))
    {
        foreach($chats as $chat)
        {
            $active = $chat->sender_id == $user_id ? 'active' : '';
            if($chat->type == 'text')
            {
                $value .='<ul class="ul-chat-body">
                            <li class="li-chat-body '.$active.' ">
                                <div class="chat-chat-body">
                                    <div class="icon text-right">
                                        <a href="#" id="'.$chat->chat_id.'" class="delete-chat-btn"> <i class="fa fa-times"></i></a>
                                    </div>
                                    <p class="chat-paragraph">'.$chat->chat.'</p>
                                    <div class="time"><span>'.chat_time($chat->time).'</span></div>
                                </div>
                            </li>
                        </ul>';
            }
            if($chat->type == 'image')
            {
                $value .= '<ul class="ul-chat-body">
                            <li class="li-chat-body image '.$active.' ">
                                <div class="chat-chat-body chat-image-body">
                                    <div class="icon text-right">
                                        <a href="#" id="'.$chat->chat_id.'" class="delete-chat-btn"> <i class="fa fa-times"></i></a>
                                    </div>
                                    <div class="chat-image">
                                        <img src="'.asset($chat->chat).'" alt="">
                                        <div class="inner-icon">
                                            <a href="'.url($chat->chat).'" download>Download <i class="fa fa-arrow-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="time"><span>'.chat_time($chat->time).'</span></div>
                                </div>
                            </li>
                        </ul>';
            }
        }
    }
    return $value;
}














// public function ajax_send_users_newsletter(Request $request)
// {
//     if($request->ajax())
//     {
//         $data = false;
//         $newsletter = Newsletter::where('id', $request->newsletter_id)->first();
//         if(!$newsletter)
//         {
//             return response()->json(['error' => '*Newsletter does not exist']);
//         }
//         if($newsletter)
//         {
//             if($request->name == 'basic')
//             {
//                 $members = User::where('membership_level', 'basic')->where('is_deactivated', 0)->get();
//             }
//             if($request->name == 'premium')
//             {
//                 $members = User::where('membership_level', 'premium')->where('is_deactivated', 0)->get();
//             }
//             foreach($members as $member)
//             {
//                 Mail::to($member->email)->send(new NewsletterMailer($newsletter));
//             }
//         }
//     }
//     return response()->json(['data' => $data]);
// }











public function ajax_add_how_it_works(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(Image::exists('image'))
            {
                $file = Image::files('image');
                $image = new Image();

                $fileName = Image::name('image', 'slider');
                $how_it_work = 'web/images/icons/'.$fileName;
                $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 10000000,'file_destination' => 'web/images/icons/' ]);
                
                if(!$image->passed())
                {
                    return response()->json(['error' => ['image' => $image->error()]]);
                }
                if($image->passed())
                {
                    $create = DB::table('how_it_works')->insert([
                        'image' => $how_it_work
                    ]);
                    if($create)
                    {
                        $data = true;
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    





    
    public function ajax_get_how_it_works(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $how_it_works = DB::table('how_it_works')->get(); //get all how it works
            if($how_it_works)
            {
                return view('admin.common.ajax-get-how-it-works', compact('how_it_works'));
            }
        }
        return response()->json(['data' => $data]);
    }











    public function ajax_delete_how_it_works(Request $request)
    {
        if($request->ajax())
        {
            $data = true;
            $image = DB::table('how_it_works')->where('id', $request->image_id)->first(); //get how it works
            if($image)
            {
                $image_img = $image->image;
                $delete = DB::table('how_it_works')->where('id', $request->image_id)->delete();
                if($delete)
                {
                    Image::remove($image_img);
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }










    public function ajax_update_how_it_works(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $image_image = DB::table('how_it_works')->where('id', $request->id)->first(); //get image
            if(!$image_image)
            {
                return response()->json(['data' => $data]);
            }

            if(Image::exists('image'))
            {
                $file = Image::files('image');
                $image = new Image();

                $fileName = Image::name('image', 'slider');
                $how_it_works_image = 'web/images/icons/'.$fileName;
                $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 10000000,'file_destination' => 'web/images/icons/' ]);
                
                if(!$image->passed())
                {
                    return response()->json(['error' => ['image' => $image->error()]]);
                }
                if($image->passed())
                {
                    $how_it_works = $image_image->image;
                    $update = DB::table('how_it_works')->where('id', $request->id)->update([
                        'image' => $how_it_works_image
                    ]);
                    if($update)
                    {
                        Image::remove($how_it_works);
                        $data = asset($how_it_works_image);
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }

    









    public function ajax_feature_how_it_works(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $how_it_work = DB::table('how_it_works')->where('id', $request->id)->first(); //get how it works
            if($how_it_work)
            {
                $is_featured = $how_it_work->is_featured ? 0 : 1;
                $update = DB::table('how_it_works')->where('id', $request->id)->update([
                        'is_featured' => $is_featured
                ]);
                if($update)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }










    public function ajax_add_mass_user_subscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'type' => 'required',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => ['all' => '*All fields are required']]);
            }

            if(!$request->stored_id)
            {
                return response()->json(['empty' => '*No member was selected!']);
            }

            if($validator->passes())
            {
                $subscription = DB::table('subscriptions')->where('type', $request->type)->first();
                if($subscription)
                {
                    $state = false;
                    foreach($request->stored_id as $id)
                    {
                        $subscribe = $this->mass_add_subcription($id, $request->amount, $subscription);
                        if(!$subscribe)
                        {
                            $state = true;
                            break;
                        }
                    }
                }
                if($state)
                {
                    return response()->json(['failed' => $data]);
                }
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
    









    public function mass_add_subcription($id, $amount, $subscription)
    {
        $state = false;
        $old_sub = DB::table('user_subscriptions')->where('user_id', $id)->where('is_expired', 0)->first();
        if($old_sub)
        {
            DB::table('user_subscriptions')->where('user_id', $id)->where('is_expired', 0)->update([
                    'is_expired' => 1,
                    'date_ended' => date('Y-m-d H:i:s')
            ]);
        }
        
        $reference = uniqid();
        $end_date = date('Y-m-d H:i:s', strtotime('+'.$subscription->duration));

        $create = DB::table('user_subscriptions')->insert([
                    'reference' => $reference,
                    'user_id' => $id,
                    'subscription_id' => $subscription->sub_id,
                    'duration' => $subscription->duration,
                    'amount' => $amount,
                    'subscription_type' => $subscription->type,
                    'start_date' => date('Y-m-d H:i:s'),
                    'end_date' => $end_date,
                ]);
        
        if($create)
        {
            $user = User::where('id', $id)->first();
            $user->membership_level = $subscription->type;
            $user->save();

          $state = true;
        }
        return $state;
    }










    public function ajax_upload_id_card_edit(Request $request)
    {
        if($request->ajax())
        {
            $data = false;

            $user = User::where('id', $request->user_id)->first(); //get user detail
            if(Image::exists('image'))
            {
                $image = new Image();
                $file = Image::files('image');

                $file_name = Image::name('image', 'ID_CARD');
                $image->upload_image($file, ['name' => $file_name, 'size_allowed' => 10000000,'file_destination' => 'web/images/ID_card/']);
                    
                $image_name = 'web/images/ID_card/'.$file_name;

                if(!$image->passed())
                {
                    return response()->json(['error' => ['image' => $image->error()]]);
                }

                if($image->passed())
                {
                    if($user->id_card){
                        Image::remove($user->id_card);
                    }
                    $user->id_card = $image_name;
                    $user->save();
                    $id_card = asset($image_name);
                    $content = $this->id_card_content($image_name);

                    return response()->json(['id_upload' => $id_card, 'content' => $content]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }









    public function id_card_content($image_name){
        $content = '';
        if($image_name)
        {
            $content .= '<div class="title-header">
                            <h4>Other details</h4>
                            <a href="#" id="edit_id_card_btn_open"><i class="fa fa-pen"></i></a>
                            <a href="#" class="text-danger delete-id-card-btn-open"><i class="fa fa-trash"></i></a>
                        </div>
                        <ul class="ul-profile-detail" id="ul_id_card_body">
                            <li>
                                <div class="title">Member ID CARD  </div>
                                <div class="body"> <a href="#" data-url="'.asset($image_name).'" id="id_card_open_btn" class="mini-btn">View ID card</a></div>
                            </li>
                        </ul>';
        }

        return $content;
    }















    public function ajax_delete_id_card(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user = User::where("id", $request->user_id)->first();
            if(!$user)
            {
                return response()->json(['not_exist' => true]);
            }

            if($user->id_card)
            {
                if(Image::remove($user->id_card))
                {
                    $user->id_card = null;
                    $user->save();
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }












    public function ajax_send_members_newsletter(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $newsletter = Newsletter::where('id', $request->newsletter_id)->first();
            if($newsletter)
            {
                foreach($request->stored_id as $id)
                {
                    $member = User::where('id', $id)->first();
                    if($member)
                    {
                        Mail::to($member->email)->send(new NewsletterMailer($newsletter));
                    }
                }
            }
            $data = true;
        }
        return response()->json(['data' => $data]);
    }









    public function ajax_update_christain(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $users = User::where('religion', 'christain')->get();
            if(count($users))
            {
                foreach($users as $user)
                {
                    $update = User::where('id', $user->id)->first();
                    $update->religion = 'christian';
                    $update->save();
                    $data = true;
                }
            }else{
                return response()->json(['empty' => true]);
            }
        }
        return response()->json(['data' => $data]);
    }
    








    public function ajax_delete_user_subscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user_subs = DB::table('user_subscriptions')->where('user_sub_id', $request->sub_id)->first();
            if($user_subs)
            {
                $delete = DB::table('user_subscriptions')->where('user_sub_id', $request->sub_id)->delete();
                if($delete)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }

    






































    // end
}
