<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Chat;
use App\Models\ContactUs;
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
                // $user->is_suspend = 0;
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



    









    public function ajax_delete_delete(Request $request)
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
            if($check && $check->end_date < $today)
            {
                $is_expired = $check->is_expired ? 0 : 1;
                $end_date = $is_expired ? $today : null;

                DB::table('user_subscriptions')->where('user_sub_id', $request->id)->update([
                        'is_expired' => $is_expired,
                        'date_ended' => $end_date
                ]);

                if($is_expired)
                {
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




    

















    // end
}
