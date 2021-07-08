<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Auth;
use App\Models\Image;
use App\Models\Chat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



use Session;
use Cookie;
use Validator;

class ClientAjaxController extends Controller
{
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
                'religion' => 'required',
                'looking_for' => 'required',
                'marital_status' => 'required',
                'hiv' => 'required',
                'complexion' => 'required|max:50',
                'career' => 'required|max:100',
                'education' => 'required|max:100',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $id = Auth::user('id');
                $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->age = $request->age;
                    $user->HIV = strtoupper($request->hiv);
                    $user->complexion = $request->complexion;
                    $user->career = $request->career;
                    $user->education = $request->education;
                    $user->location = strtolower($request->location);
                    $user->genotype = $request->genotype;
                    $user->religion = strtolower($request->religion);
                    $user->looking_for = $request->looking_for;
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
            $user = $this->user_detail();

            $gender = $user->gender == 'male' ? 'man' : 'woman'; // gender

            $display_name = $user->display_name ? $user->display_name : $user->user_name; //user name

            return view('web.common.ajax-edit-detail-info', compact('user', 'gender', 'display_name'));
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
                $id = Auth::user('id');
                $user = User::where('id', $id)->first(); //get user detail
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
    








    public function ajax_get_about_me(Request $request)
    {
        if($request->ajax())
        {
            $user = $this->user_detail();
            return view('web.common.ajax-get-about-me', compact('user'));
        }
        return response()->json(['data' => true]);
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
                $id = Auth::user('id');
                $user = User::where('id', $id)->first(); //get user detail
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

   




    public function ajax_get_looking_for(Request $request)
    {
        if($request->ajax())
        {
            $user = $this->user_detail();
            return view('web.common.ajax-get-looking-for', compact('user'));
        }
        return response()->json(['data' => true]);
    }




    public function user_detail(){
        $id = Auth::user('id');
        $user = User::where('id', $id)->first(); //get user detail
        return $user;
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
                $id = Auth::user('id');
                $user = User::where('id', $id)->first(); //get user detail
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
            $user = $this->user_detail();
            return view('web.common.ajax-get-lifestyle', compact('user'));
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
                $id = Auth::user('id');
                $user = User::where('id', $id)->first(); //get user detail
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
            $user = $this->user_detail();
            return view('web.common.ajax-get-physical-info', compact('user'));
        }
        return response()->json(['data' => true]);
    }






    public function ajax_upload_id_card(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            
            $id = Auth::user('id');
            Session::put('subscription', $request->sub_id);
            $user = User::where('id', $id)->first(); //get user detail

            if(!$user)
            {
                Session::put('old_url', url('/subscription'));
                return response()->json(['login' => url('/login')]);
            }

            $image = new Image();
            $file = Image::files('image');

            $file_name = Image::name('image', 'ID_CARD');
            $image->upload_image($file, ['name' => $file_name, 'size_allowed' => 1000000,'file_destination' => 'web/images/ID_card/']);
                
            $image_name = 'web/images/ID_card/'.$file_name;

            if(!$image->passed())
            {
                return response()->json(['error' => ['image' => $image->error()]]);
            }

            if($image->passed())
            {
                $data = true;
                $user->id_card = $image_name;
                $user->save();
            }
        }
        return response()->json(['data' => $data]);
    }
    






    public function ajax_subscribe_now(Request $request)
    {
        if($request->ajax())
        {
            $data = false;

            $id = Auth::user('id');
            $user = User::where('id', $id)->first(); //get user detail

            if(!$user)
            {
                Session::put('old_url', url('/subscription'));
                return response()->json(['login' => url('/login')]);
            }

            if(!$user->id_card)
            {
                return response()->json(['id_card' => true]);
            }

            if($user && $user->id_card)
            {
                $data = true;
                Session::put('subscription', $request->sub_id);
            }
        }
        return response()->json(['data' => $data]);
    }
    









    public function ajax_logout(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if(Auth::logout())
            {
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }







    public function ajax_login_check(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            Session::put('old_url', $request->current_url);
            $data = url('/login');
        }
        return response()->json(['data' => $data]);
    }










    public function ajax_like_user(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user = $this->user_detail();
            if($user->membership_level == 'basic') //when you are a basic
            {
                $data = $this->run_as_basic($request->user_id);
                if($data == 'subscribe_to_premium')
                {
                    return response()->json(['subscribe_to_premium' => true]);
                }
                if($data == 'like_this_user')
                {
                    return response()->json(['like_this_user' => true]);
                }
                if($data == 'subscribe')
                {
                    return response()->json(['subscribe' => true]);
                }
            }


            if($user->membership_level == 'premium')//when you are a premium
            {
                $data = $this->run_as_premium($request->user_id);
                if($data == 'subscribe')
                {
                    return response()->json(['subscribe' => true]);
                }
                if($data == 'like_this_user')
                {
                    return response()->json(['like_this_user' => true]);
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    









    public function run_as_premium($user_id)
    {
        $user_sub = DB::table('user_subscriptions')->where('subscription_type', 'premium')->where('user_id', Auth::user('id'))->where('is_expired', 0)->first();
        if(!$user_sub)
        {
            return 'subscribe';
        }

        if($user_sub)
        {
            $this->initiator_like($user_id);
            return 'like_this_user';
        }

        return false;
    }









    public function run_as_basic($user_id)
    {
        $acceptor = User::where('id', $user_id)->first();
        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->where('sub_is_featured', 1)->first();

        if($acceptor && $acceptor->membership_level != $basic_sub->type)
        {
            return 'subscribe_to_premium';
        }

        if($basic_sub->amount == 0) // like user when basic is free
        {
            $this->initiator_like($user_id);
            return 'like_this_user';
        }

        if($basic_sub->amount > 0)// like user when basic is not free
        {
            $user_sub = DB::table('user_subscriptions')->where('user_id', Auth::user('id'))->where('is_expired', 0)->first();
            if(!$user_sub)
            {
                return 'subscribe';
            }

            if($user_sub)
            {
                $this->initiator_like($user_id);
                return 'like_this_user';
            }
        }

        return false;
    }













     public function initiator_like($user_id)
     {
        $user = $this->user_detail();

        $upadate_like = DB::table('likes')->insert([
                        'initiator_id' => Auth::user('id'),
                        'acceptor_id' => $user_id,
                    ]);
       //you can choose to send a notification here
        return true;
     }








    public function ajax_subscribe_plan(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            Session::put('profile_url', $request->current_url);
            $data = url('/subscription');
        }
        return response()->json(['data' => $data]);
    }









    public function ajax_cancle_like_request(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $unlike = $this->unlike_user($request->user_id);
            if($unlike)
            {
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }







    public function unlike_user($user_id)
    {
        $data = false;
        if($user_id)
        {
            $like_id = null;

            $you_liked = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $user_id)->first(); 
            if($you_liked)
            {
                $like_id = $you_liked->like_id;
            }else{
                $was_liked = DB::table('likes')->where('initiator_id', $user_id)->where('acceptor_id', Auth::user('id'))->first();
                $like_id = $was_liked->like_id;
            }
           
            if($like_id)
            {
                $cancle_like = DB::table('likes')->where('like_id', $like_id)->delete();
                if($cancle_like)
                {
                    $data = true;
                }
            }
        }
        return $data;
    }








     public function ajax_accept_like_request(Request $request)
     {
        if($request->ajax())
        {
            $data = false;
            $user = User::where('id', $request->user_id)->first(); //get user detail
            $subscription = DB::table('subscriptions')->where('type', 'basic')->first();
            $my_sub = DB::table('user_subscriptions')->where('user_id', Auth::user('id'))->where('is_expired', 0)->first();           

            if($subscription && $subscription->amount != 0)
            {
                if(Auth::user('membership_level') == 'basic' && $user->membership_level == 'premium')
                {
                    return response()->json(['subscribe_to_premium' => true]);
                }

                if(!$my_sub)
                {
                    return response()->json(['subscribe' => true]);
                }
            }

            if($subscription && $subscription->amount == 0)
            {
                if(Auth::user('membership_level') == 'basic' && $user->membership_level == 'premium')
                {
                    return response()->json(['subscribe_to_premium' => true]);
                }
            }
            
              
            $accept = DB::table('likes')->where('initiator_id', $request->user_id)->where('acceptor_id', Auth::user('id'))->update([
                'is_accept' => 1
            ]);

            if($accept)
            {
                return response()->json(['matched' => true]);
            }
        }
        return response()->json(['data' => $data]);
     }








    public function ajax_get_profile_links(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user = User::where('id', $request->user_id)->where('is_deactivated', 0)->first(); //get user detail
            if($user)
            {
                $you_liked = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $request->user_id)->first(); //you liked this user
                $was_liked = DB::table('likes')->where('initiator_id', $request->user_id)->where('acceptor_id', Auth::user('id'))->first(); // this user liked you
            
                return view('web.common.ajax-get-profile-links', compact('you_liked', 'was_liked', 'user'));
            }
        }
        return response()->json(['data' => $data]);
    }






    


     public function ajax_get_matched_detail(Request $request)
     {
        if($request->ajax())
        {
            $data = false;
            $user = User::where('id', $request->user_id)->first(); //get user detail
            if($user)
            {
                $display_name = $user->display_name ? ucfirst($user->display_name) : $user->user_name; //user name
            
                return view('web.common.ajax-matched-modal-popup', compact('display_name', 'user'));
            }
        }
        return response()->json(['data' => $data]);
     }











     public function ajax_get_users_notification_count(Request $request)
     {
        if($request->ajax())
        {
            $data = false;
            if(Auth::is_loggedin())
            {
                $like_count = DB::table('likes')->where('acceptor_id', Auth::user('id'))->where('is_accept', 0)->get();
                if(count($like_count))
                {
                    $data = count($like_count);
                }
            }
        }
        return response()->json(['data' => $data]);
     }







    public function ajax_unlike_matched_user(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $unlike = $this->unlike_user($request->user_id);
            if($unlike)
            {
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
     












    public function ajax_call_user(Request $request)
     {
        if($request->ajax())
        {
            $data = false;
            $user = $this->user_detail();
            $acceptor = User::where('id', $request->user_id)->first();

            if($user->membership_level == 'basic' && $acceptor && $acceptor->membership_level != 'basic')
            {
                return response()->json(['subscribe_to_premium' => true]);
            }

            $basic_sub = DB::table('subscriptions')->where('type', 'basic')->where('sub_is_featured', 1)->first();
            if($basic_sub->amount == 0 && $user->membership_level == 'basic')
            {
                $data = $this->make_a_call($request->user_id);  // craete a make call feature
            }
            
            if($basic_sub->amount > 0 && $user->membership_level == 'basic')
            {
                $my_sub = DB::table('user_subscriptions')->where('user_id', Auth::user('id'))->where('is_expired', 0)->first();
                if(!$my_sub)
                {
                    return response()->json(['subscribe' => true]);
                }
            }

            $premium_sub = DB::table('user_subscriptions')->where('subscription_type', 'premium')->where('user_id', Auth::user('id'))->where('is_expired', 0)->first();
            if($user->membership_level == 'premium' && !$premium_sub)
            {
                return response()->json(['subscribe' => true]);
            }
            
            $data = $this->make_a_call($request->user_id);  // craete a make call feature
        }
        return response()->json(['data' => $data]);
     }
     










     public function make_a_call($user_id)
     {
        return 'make a call';
     }










    public function ajax_get_user_chats(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $receiver_id = $request->receiver_id;

            $chats = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                        ->orWhere(function($query) use ($receiver_id){
                        $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                    })->get();
    
            return view('web.chat.ajax-get-chat', compact('chats'));
        }
        return response()->json(['error' => $data]);
    }
     






    public function ajax_send_user_text_chats(Request $request)
    {
       if($request->ajax())
       {
            $data = false;
            $receiver_id = $request->receiver_id;
            $chat_token_1 = 'chat_'.Auth::user('id').'_'.$receiver_id;
            $chat_token_2 = 'chat_'.$receiver_id.'_'.Auth::user('id');

            $chat_exists = Chat::where('chat_token', $chat_token_1)->orWhere('chat_token', $chat_token_2)->first();
            
            $chat_token = $chat_token_1;
            if($chat_exists)
            {
                $chat_token = $chat_exists->chat_token;
            }

            $create = Chat::create([
                'chat_token' => $chat_token,
                'sender_id' => Auth::user('id'),
                'receiver_id' => $receiver_id,
                'chat' => $request->chat,
                'type' => 'text'
            ]);
            if($create)
            {
                $data = true;
            }
       }
       return response()->json(['data' => $data]);
   }
    








   public function ajax_upload_chat_image(Request $request)
   {
       if($request->ajax())
       {
           if(Image::exists('image'))
           {
               $file = Image::files('image');
               $image = new Image();

               $fileName = Image::name('image', 'picture');
               $chat_image = 'web/images/picture/'.$fileName;
               $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 1000000,'file_destination' => 'web/images/picture/' ]);
               
               if(!$image->passed())
               {
                   return response()->json(['error' => ['image' => $image->error()]]);
               }
             
               if($image->passed())
               {
               
                    $receiver_id = $request->input('receiver_id');
                    $chat_token_1 = 'chat_'.Auth::user('id').'_'.$receiver_id;
                    $chat_token_2 = 'chat_'.$receiver_id.'_'.Auth::user('id');

                    $chat_exists = Chat::where('chat_token', $chat_token_1)->orWhere('chat_token', $chat_token_2)->first();
                    
                    $chat_token = $chat_token_1;
                    if($chat_exists)
                    {
                        $chat_token = $chat_exists->chat_token;
                    }

                    $create = Chat::create([
                       'chat_token' => $chat_token,
                       'sender_id' => Auth::user('id'),
                       'receiver_id' => $receiver_id,
                       'chat' => $chat_image,
                       'type' => 'image'
                    ]);

                    if($create)
                    {
                       $chats = $this->get_chat($receiver_id);
                       return view('web.chat.ajax-get-chat', compact('chats'));
                    }
               }
           }
       }
       return response()->json(['data_error' => true]);
   }







   public function get_chat($receiver_id)
   {
        if($receiver_id)
        {
            $chats = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                        ->orWhere(function($query) use ($receiver_id){
                        $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                    })->get();
        } 
        return $chats;
   }









   public function ajax_delete_user_chats(Request $request)
   {
        if($request->ajax())
        {
            $data = false;

            $chat = Chat::where('chat_id', $request->chat_id)->first();
            if($chat && $chat->sender_id == Auth::user('id'))
            {
                $data = true;
                DB::table('chats')->where('chat_id', $request->chat_id)->update([
                    'sender_delete' => 1
                ]);
            }

            if($chat && $chat->receiver_id == Auth::user('id'))
            {
                $data = true;
                DB::table('chats')->where('chat_id', $request->chat_id)->update([
                    'receiver_delete' => 1
                ]);
            }
        }
        return response()->json(['data' => $data]);
    }
   















    public function ajax_newsletter_subscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:newsletter_subscriptions',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }
            
            if($validator->passes())
            {
                $create = DB::table('newsletter_subscriptions')->insert([
                    'email' => $request->email
                ]);
                if($create)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }
    










    public function ajax_newsletter_unsubscription(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                $check = DB::table('newsletter_subscriptions')->where('email', $request->email)->first();
                if(!$check)
                {
                    return response()->json(['error' => ['email' => '*Email does not exists']]);
                }
                
                if($check)
                {
                    DB::table('newsletter_subscriptions')->where('id', $check->id)->delete();
                    $data = true;            
                }
            }
        }
        return response()->json(['data' => $data]);
    }











    

    public function ajax_report_member(Request $request)
    {
        if($request->ajax())
        {
            $data = false;  
            if($request->report_id == 'other')
            {
                $validator = Validator::make($request->all(), [
                    'other_report' => 'required|max:1000',
                ]);
    
                if(!$validator->passes())
                {
                    return response()->json(['error' => $validator->errors()]);
                }  
                
                $report = $request->other_report;
            }

            if($request->report_id != 'other')
            {
                $get_report = DB::table('reports')->where('id', $request->report_id)->first();
                if($get_report)
                {
                    $report = $get_report->report;
                }
            }
            
            $user_id = $request->user_id;
            $is_friends = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $user_id)
                            ->orWhere(function($query) use ($user_id){
                                $query->where('initiator_id', $user_id)->where('acceptor_id', Auth::user('id'));
                            })->first();

            if(!$is_friends)
            {
                return response()->json(['not_friends' => true]);
            }

             if($request->report_id == 'other' || $request->report_id != 'other')
            {
                $create_report = DB::table('user_reports')->insert([
                    'reporter_id' => Auth::user('id'),
                    'reported_id' => $request->user_id,
                    'report' => $report,
                ]);
                
                if($create_report)
                {
                    $data = true;
                }
            }
        }
        return response()->json(['data' => $data]);
    }






    



    public function ajax_get_member_links(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user = User::where('id', $request->user_id)->first();
            if($user)
            {
                return view('web.common.ajax-get-member-links', compact('user'));
            }
        }
        return response()->json(['data' => $data]);
    }
    







    public function ajax_remove_subscription_notification(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $notification = DB::table('notifications')->where('not_id', $request->id)->first();
            if($notification)
            {
                $delete = DB::table('notifications')->where('not_id', $request->id)->delete();
                if($delete)
                {
                    $data =  'notification deleted';
                }
            } 
        }
        return response()->json(['data' => $data]);
    }


    





    public function ajax_mark_seen_user_chat(Request $request)
    {
        if($request->ajax())
        {
            $data = true;
            
            $chats = Chat::where('chat_token', $request->chat_token)->where('receiver_id', Auth::user('id'))->where('is_seen', 0)->get();
            if(count($chats))
            {
                foreach($chats as $chat)
                {
                    $chat = DB::table('chats')->where('chat_id', $chat->chat_id)->update([
                        'is_seen' => 1
                    ]);
                }
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }
    








    public function ajax_max_users_message_delete(Request $request)
    {
        if($request->ajax())
        {
            $data = true;
            $user_id = $request->user_id;
            $chats = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $user_id)->where('sender_delete', 0)->orWhere(function($query) use ($user_id){
                               $query->where('sender_id', $user_id)->where('receiver_id', Auth::user('id'))->where('receiver_delete', 0);
                        })->get();
            
           
            if(count($chats))
            {
                foreach($chats as $chat)
                {
                    if($chat->sender_id == Auth::user('id'))
                    {
                        DB::table('chats')->where('chat_id', $chat->chat_id)->update([
                            'sender_delete' => 1
                        ]);
                    }
                    if($chat->receiver_id == Auth::user('id'))
                    {
                        DB::table('chats')->where('chat_id', $chat->chat_id)->update([
                            'receiver_delete' => 1
                        ]);
                    }
                }
                $data = true;
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
            $receiver_id = $request->user_id;
            $chat = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                        ->orWhere(function($query) use ($receiver_id){
                        $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                    });

            $count = count($chat->get());
            
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
            $data  = $this->get_user_chat($chats);
        }
        return response()->json(['data' => $data, 'remender' => $remender]);
    }









public function get_user_chat($chats)
{
    $value = '';
    if(count($chats))
    {
        foreach($chats as $chat)
        {
            $active = $chat->sender_id == Auth::user('id') ? 'active' : '';
            if($chat->type == 'text')
            {
                $value .='<ul class="ul-chat-content">
                            <li class="li-chat-content '.$active.'">
                                <div class="inner-chat-content">
                                    <div class="chat-content-option">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <ul class="ul-option-body '.$active.'">
                                            <li><a href="#" id="'.$chat->chat_id.'" class="delete-chat-btn">Delete</a></li>
                                        </ul>
                                    </div>
                                    <p>'.$chat->chat.'</p>
                                    <div class="time"><i class="fa fa-clock"></i>'.chat_time($chat->time).'</div>
                                </div>
                            </li>
                        </ul>';

                        
            }
            if($chat->type == 'image')
            {
                $value .='<ul class="ul-chat-content">
                            <li class="li-chat-img-content '.$active.'">
                                <div>
                                    <div class="chat-content-option">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <ul class="ul-option-body '.$active.'">
                                            <li><a href="#" id="'.$chat->chat_id.'" class="delete-chat-btn">Delete</a></li>
                                            <li><a href="'.url($chat->chat).'" download>Download</a></li>
                                        </ul>
                                    </div>
                                    <div class="chat-img">
                                        <img src="'.asset($chat->chat).'" alt="">
                                    </div>
                                    <div class="time"><i class="fa fa-clock"></i>'.chat_time($chat->time).'</div>
                                </div>
                            </li>
                        </ul>';
            }
        }
    }
    return $value;
}

























    

    // end
}
