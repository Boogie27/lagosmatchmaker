<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Auth;
use App\Models\Image;
use App\Models\Chat;
use App\Models\Block;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use App\Mail\Matchmail;


use Mail;
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
                'country' => 'required',
                'complexion' => 'required|max:50',
                'career' => 'required|max:100',
                'phone' => 'required|min:11|max:20',
                'university' => 'required|max:100',
                'state_of_origin' => 'required',
            ]);

            if(preg_match('/@/', $request->display_name))
            {
                return response()->json(['error' => ['display_name' => '*Must not use @ or an email address']]);
            }


            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if($validator->passes())
            {
                if(!is_numeric($request->phone))
                {
                    return response()->json(['error' => ['phone' => '*Wrong phone number format!']]);
                }
                if($request->age < 18)
                {
                    return response()->json(['error' => ['age' => '*You must be 18+!']]);
                }

                $id = Auth::user('id');
                $user = User::where('id', $id)->first(); //get user detail
                if($user)
                {
                    $user->age = $request->age;
                    $user->gender = $request->i_am;
                    $user->phone = $request->phone;
                    $user->country = $request->country;
                    $user->HIV = strtoupper($request->hiv);
                    $user->complexion = $request->complexion;
                    $user->career = $request->career;
                    $user->children = $request->children;
                    $user->birth_date = $request->birth_date;
                    $user->education = $request->university;
                    $user->location = strtolower($request->location);
                    $user->genotype = $request->genotype;
                    $user->religion = strtolower($request->religion);
                    $user->looking_for = $request->looking_for;
                    $user->marital_status = strtolower($request->marital_status);
                    $user->display_name = strtolower($request->display_name);
                    $user->state_of_origin = strtolower($request->state_of_origin);
                    if($user->save())
                    {
                        $data = true;
                        $this->complete_detail();
                    }
                }
            }
        }
        return response()->json(['data' => $data]);
    }






    public function complete_detail()
    {
        $state = false;
        $user = User::where('id', Auth::user('id'))->first(); //get user detail

        if($user->about && $user->age && $user->location && 
            $user->marital_status && $user->religion && $user->looking_for && 
            $user->smoking && $user->drinking && $user->interest 
            && $user->genotype && $user->language && $user->height && $user->weight 
            && $user->body_type && $user->ethnicity && $user->HIV && $user->complexion 
            && $user->education && $user->career && $user->state_of_origin && $user->phone && !$user->is_complete)
            {
                $state = true;
                $user->is_approved = 1;
                $user->is_complete = 1;
                $user->save();
            }
        return $state;
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
                        $this->complete_detail();
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
                        $this->complete_detail();
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
                        $this->complete_detail();
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
                'ethnicity' => 'required',
                'body_type' => 'required',
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

                    if($user->save())
                    {
                        $data = true;
                        $this->complete_detail();
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
            $image->upload_image($file, ['name' => $file_name, 'size_allowed' => 10000000,'file_destination' => 'web/images/ID_card/']);
                
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
                $daily_matches = $this->daily_matches($user, $request->user_id);
                if($daily_matches == 'daily_count_completed')
                {
                    return response()->json(['daily_count_completed' => true]);
                }

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

       //send a notification email to other user
       $acceptor = User::where('id', $user_id)->first();
       $message = 'You have a new match notification, '.Auth::user('user_name').' has matched with you on MatchmakerDidi.';
       $this->match_mail($acceptor->email, $message);

        return true;
     }







     public function daily_matches($user, $user_id)
     {
        //count basic user daily match
        $check_subscription = DB::table('subscriptions')->where('type', 'basic')->first();
        if($check_subscription)
        {
            if($check_subscription->sub_is_featured && $check_subscription->daily_request > 0)
            {
                $counter = $check_subscription->daily_request;
                $today = date('Y-m-d H:i:s');
                $tomorrow = date('Y-m-d H:i:s', strtotime('+ 1day'));
                $matches[$user_id] = ['id' => $user_id, 'time' => $today];
        
                $old_daily_match = DB::table('daily_matches')->where('user_id', $user->id)->first();
        
                if($old_daily_match && $today >= $old_daily_match->match_expire)
                {
                    $delete = DB::table('daily_matches')->where('id', $old_daily_match->id)->delete();
                }
        
                $daily_match = DB::table('daily_matches')->where('user_id', $user->id)->first();
                if($user->membership_level == 'basic' && !$daily_match)
                {
                    $create = DB::table('daily_matches')->insert([
                            'user_id' => $user->id,
                            'match_id' => json_encode($matches),
                            'counter' => 1,
                            'date_matched' => $today,
                            'match_expire' => $tomorrow,
                   ]);
                }else if($daily_match && $user->membership_level == 'basic' && $daily_match->counter < $counter && $daily_match->match_expire > $today)
                {
                    $matches = json_decode($daily_match->match_id, true);
                    if(!array_key_exists($user_id, $matches))
                    {
                        $matches[$user_id] = ['id' => $user_id, 'time' => $today];
        
                        $update = DB::table('daily_matches')->where('user_id', $user->id)->update([
                            'match_id' => json_encode($matches),
                            'counter' => $daily_match->counter += 1
                        ]);
                        if($update) return;
                    }
                }
        
                if($daily_match && $daily_match->counter == $counter && $daily_match->match_expire > $today)
                {
                    return 'daily_count_completed';
                }
            }
        }
     }








    public function ajax_subscribe_plan(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            Session::put('profile_url', $request->current_url);
            $data = url('/manual-payment');
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
              
            $accept = DB::table('likes')->where('initiator_id', $request->user_id)->where('acceptor_id', Auth::user('id'))->update([
                'is_accept' => 1
            ]);

            if($accept)
            {
                $initiator = User::where('id', $request->user_id)->first();

                $message = Auth::user('user_name').' has accepted your match on MatchmakerDidi, now you can chat with eachother.';
                
                // $this->match_mail($initiator->email, $message);
                
                $avatar = is_matched_avatar($request->user_id);

                return response()->json(['matched' => true, 'avatar' => $avatar]);
            }
        }
        return response()->json(['data' => $data]);
     }








    public function match_mail($email, $message)
    {
        Mail::to($email)->send(new Matchmail($message));
    }





    public function chat_mail($email, $message)
    {
        Mail::to($email)->send(new Matchmail($message));
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
                'type' => 'text',
                'time' => date('Y-m-d H:i:s')
            ]);
            if($create)
            {
                $check = User::where('id', $request->receiver_id)->first();
                if($check)
                {
                    $message = $check->user_name.' You have one new message from '.Auth::user('user_name').' on MatchmakerDidi';
                    $this->chat_mail($check->email, $message);
                }
                $data = true;
            }
       }
       return response()->json(['data' => $data]);
   }
    


  





   public function ajax_upload_chat_image(Request $request)
   {
       if($request->ajax())
       {
            $data = false;
           if(Image::exists('image'))
           {
               $file = Image::files('image');
               $image = new Image();

               $fileName = Image::name('image', 'picture');
               $chat_image = 'web/images/picture/'.$fileName;
               $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 10000000,'file_destination' => 'web/images/picture/' ]);
               
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
                       'type' => 'image',
                       'time' => date('Y-m-d H:i:s')
                    ]);

                    if($create)
                    {
                        $check = User::where('id', $receiver_id)->first();
                        if($check && !$check->is_active)
                        {
                            $message = $check->user_name.' You have one new message from '.Auth::user('user_name').' on MatchmakerDidi';
                            $this->chat_mail($check->email, $message);
                        }
                        $data = true;
                    }
               }
           }
       }
       return response()->json(['data' => $data]);
   }







   public function get_chat($receiver_id)
   {
        if($receiver_id)
        {
            $chat = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                        ->orWhere(function($query) use ($receiver_id){
                        $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                    });

            $chats = $chat->skip(0)->take(8)->orderBy('chat_id', 'DESC')->get();
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
            $notification = DB::table('notifications')->where('not_id', $request->not_id)->first();
            if($notification)
            {
                $delete = DB::table('notifications')->where('not_id', $request->not_id)->delete();
                if($delete)
                {
                    $data =  true;
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
            $data = false;
            $max = false;
            $remender = 0;
            $receiver_id = $request->user_id;
            $chat = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                        ->orWhere(function($query) use ($receiver_id){
                        $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                    });

            $count = count($chat->get());
            

            if($request->remender && $request->remender < $request->take)
            {
                $max = true;
                $chats = $chat->limit($request->remender)->get();
                $data  = $this->get_user_chat($chats);
            }else{
                $skip = $count - $request->skip;
                $chats = $chat->skip($skip)->take($request->take)->get();
                if($count <= $request->skip)
                {
                    $max = true;
                }
                $remender = $skip;
                $data  = $this->get_user_chat($chats);
            }
        }
        return response()->json(['data' => $data, 'remender' => $remender, 'max' => $max]);
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
                                    <div class="time"><i class="fa fa-clock"></i> '.chat_time($chat->time).'</div>
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
                                    <div class="time"><i class="fa fa-clock"></i> '.chat_time($chat->time).'</div>
                                </div>
                            </li>
                        </ul>';
            }
        }
    }
    return $value;
}













public function ajax_get_user_chats(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $receiver_id = $request->receiver_id;

        $chat = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                    ->orWhere(function($query) use ($receiver_id){
                    $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                });

        $count = count($chat->get());
        if($count)
        {
            $skip = $count - $request->take;
            $remender = $skip;
            $chats = $chat->skip($skip)->take($request->take)->get();
            
            $data  = $this->get_user_chat($chats);
        }
    }
    return response()->json(['data' => $data, 'remender' => $remender]);
}








public function ajax_check_member_detail(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $payment_page = url('/manual-payment');
        if(!Auth::is_loggedin())
        {
            $login = url('/login');
            return response()->json(['login' => $login]);
        }

        $user = user_detail();
        $subscription = DB::table('subscriptions')->where('sub_id', $request->sub_id)->first();
        if($user->membership_level == 'basic' && $subscription->type == 'premium')
        {
            if(empty($user->id_card))
            {
                return response()->json(['upload_id' => true]);
            }else{
                return response()->json(['payment_page' => $payment_page]);
            }
        }

        if($user->membership_level == 'premium' && $subscription->type == 'premium')
        {
            if(empty($user->id_card))
            {
                return response()->json(['upload_id' => true]);
            }else{
                return response()->json(['payment_page' => $payment_page]);
            }
        }

        if($user->membership_level == 'basic' && $subscription->type == 'basic')
        {
            return response()->json(['payment_page' => $payment_page]);
        }
    }
    return response()->json(['data' => $data]);
}








    public function upload_ID_card_index(Request $request)
    {
        if($request->ajax())
        {
            $data = false;

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
                    $data = true;
                    $user = User::where('id', Auth::user('id'))->first(); //get user detail
                    if($user->id_card){
                        Image::remove($user->id_card);
                    }
                    $user->id_card = $image_name;
                    $user->save();
                }
            }
        }
        return response()->json(['data' => $data]);
    }










    public function delete_approved_notification(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $notification = DB::table('notifications')->where('not_id', $request->not_id)->first();
            if($notification)
            {
                $data = true;
                DB::table('notifications')->where('not_id', $request->not_id)->delete();
            }
        }
        return response()->json(['data' => $data]);
    }
    





    









    public function ajax_add_profile_image(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if($request->image)
            {
                $encode_1 = explode(';', $request->image);
                $encode_2 = explode(',', $encode_1[1]);

                $image = base64_decode($encode_2[1]);
                $image_name = 'web/images/avatar/avatar_'.time().'.png';
                
                if(file_put_contents($image_name, $image))
                {
                    $user = User::where('id', Auth::user('id'))->first();
                    if($user && $user->avatar)
                    {
                        Image::remove($user->avatar);
                    }

                    if(!$user)
                    {
                        Image::remove($image_name);
                    }else{
                        $user->avatar = $image_name;
                        $user->save();

                        $data = asset($image_name);
                    }
                }
            } 
        }
        return response()->json(['data' => $data]);
    }











    public function ajax_add_registered_profile_image(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            if($request->image)
            {
                if(!Session::has('register_details')){
                    return response()->json(['data' => $data]);
                }
                
                $encode_1 = explode(';', $request->image);
                $encode_2 = explode(',', $encode_1[1]);

                $image = base64_decode($encode_2[1]);
                $image_name = 'web/images/avatar/avatar_'.time().'.png';
                
                if(file_put_contents($image_name, $image))
                {
                    $user_detail = Session::get('register_details');
                    $register = User::create([
                        'avatar' => $image_name,
                        'membership_level' => 'basic',
                        'gender' => $user_detail['gender'],
                        'phone' => $user_detail['phone'],
                        'user_name' => $user_detail['username'],
                        'email' => strtolower($user_detail['email']),
                        'password' => hash::make($user_detail['password'])
                    ]);
                    if($register && Auth::login($user_detail['email'])){
                        $id = Auth::user('id');

                        //send notification to admin
                        DB::table('notifications')->insert([
                            'notification_from' => $id,
                            'notification_to' => 'admin',
                            'title' => $user_detail['username'],
                            'type' => 'register',
                            'description' => $user_detail['username'].' has just registered with MatchmakerDidi',
                            'link' => 'admin/member-detail/'.$id,
                        ]);

                        Session::flash('success', 'Account created successfully');
                        $data = url('/profile/'.$id);
                    }
                }
            } 
        }
        return response()->json(['data' => $data]);
    }
    











    public function ajax_delete_user_profile_image(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user = User::where('id', Auth::user('id'))->first();
            if($user && !$user->avatar)
            {
                return response()->json(['no_avatar' => true]);
            }

            $gender = $user->gender;
            $profile_image = $user->avatar;
            $user->avatar = null;
            if($user->save())
            {
                Image::remove($profile_image);
                $data = asset(avatar($gender));
            }
        }
        return response()->json(['data' => $data]);
    }








    public function ajax_block_member(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
           

            $check = Block::where('blocker', Auth::user('id'))->where('blocked_member', $request->user_id)->first();
            if($check)
            {
                $unblock = Block::where('blocker', Auth::user('id'))->where('blocked_member', $request->user_id)->delete();
                if($unblock)
                {
                    $data = 'unblocked';
                }
            }else{
                $block = Block::create([
                    'blocker' => Auth::user('id'),
                    'blocked_member' => $request->user_id,
                    'block_date' => date('Y-m-d H:i:s'),
                ]);
                if($block)
                {
                    $data = 'blocked';
                }
            }
            $is_matched = is_matched($request->user_id);

            $is_blocked = is_blocked(Auth::user('id'), $request->user_id);
        }
        return response()->json(['data' => $data, 'is_blocked' => $is_blocked, 'is_matched' => $is_matched]);
    }
    








    public function ajax_deactivate_account(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $user = User::where('id', Auth::user('id'))->first();
            if($user)
            {
                $user->is_active = 0;
                $user->is_deactivated = 1;
                $user->date_deactivated = date('Y-m-d H:i:s');
                $user->save();
                if($user->save())
                {
                    $data = url('/login');
                    Session::forget('user');
                    Session::flash('success', 'Account has been deactivated successfully!');
                }
            }
        }
        return response()->json(['data' => $data]);
    }

    









    public function register_new_members_ajax(Request $request)
    {
        if($request->ajax())
        {
            $data = false;
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:3|max:50',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:12',
                'confirm_password' => 'required|min:6|max:12|same:confirm_password',
                'phone' => 'required|min:11|max:13',
                'gender' => 'required'
            ]);

            if(!$validator->passes())
            {
                return response()->json(['error' => $validator->errors()]);
            }

            if(preg_match('/@/', $request->username))
            {
                return response()->json(['error' => ['username' => '*Must not use @ or an email address']]);
            }

            if($validator->passes())
            {
                $register_details['username'] = $request->username;
                $register_details['email'] = $request->email;
                $register_details['phone'] = $request->phone;
                $register_details['password'] = $request->password;
                $register_details['gender'] = $request->gender;

                Session::put('register_details', $register_details);
                $data = true;
            }
        }
        return response()->json(['data' => $data]);
    }

    








 public function ajax_get_daily_match_request(Request $request)
 {
    if($request->ajax())
    {
        $data = false;
        $daily_matches = DB::table('daily_matches')->where('user_id', Auth::user('id'))->first();
        return view('web.profile.matches-requests', compact('daily_matches'));
    }
 }










public function ajax_umatch_member(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $check = DB::table('likes')->where('like_id', $request->like_id)->first();
        if($check)
        {
            $unmatch = DB::table('likes')->where('like_id', $request->like_id)->delete();
            if($unmatch)
            {
                $data = true;
            }
        }
    }
    return response()->json(['data' => $data]);
}










public function ajax_fetch_user_matches(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $friends = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('is_accept', 1)->orWhere('acceptor_id', Auth::user('id'))->where('is_accept', 1)->get();

        return view('web.profile.matches', compact('friends'));
    }
}










public function ajax_cancel_match_request(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $check = DB::table('likes')->where('like_id', $request->like_id)->first();
        if($check)
        {
            $unmatch = DB::table('likes')->where('like_id', $request->like_id)->delete();
            if($unmatch)
            {
                $data = true;
            }
        }
    }
    return response()->json(['data' => $data]);
}












public function ajax_fetch_member_matches_request(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $friends_request = DB::table('likes')->where('acceptor_id', Auth::user('id'))->where('is_accept', 0)->leftJoin('users', 'likes.initiator_id', 'users.id')->get();

        return view('web.profile.friend-request', compact('friends_request'));
    }
}










public function ajax_fetch_user_sent_request(Request $request)
{
    if($request->ajax())
    {
        $data = false;
        $sent_request = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('is_accept', 0)->leftJoin('users', 'likes.acceptor_id', 'users.id')->get();

        return view('web.profile.sent-request', compact('sent_request'));
    }
}





















    

    // end
}
