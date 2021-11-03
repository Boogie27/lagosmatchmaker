<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Auth;
use App\Models\Paystack;
use App\Models\Chat;
use App\Models\Block;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Session;
use Cookie;
use Mail;


use App\Jobs\SendEmailJob;
use App\Mail\UserMail;
use App\Mail\NewUsernameMailer;
use App\Mail\UserResetPaswordMailer;








class ClientController extends Controller
{
    public function index()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $banners = DB::table('banners')->where('is_featured', 1)->get(); //get slider banners
       
        $subscriptions = DB::table('subscriptions')->where('sub_is_featured', 1)->get(); //get all subscriptions options
       
        $latest_members = User::where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->orderBy('id', 'DESC')->limit(8)->get();

        $images = null;
        $personalized = null;
        $descriptions = null;

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings && $settings->personalized_match)
        {
            $personalized = json_decode($settings->personalized_match, true);
        }

        if($settings && $settings->friendship_matching)
        {
            $friendship = json_decode($settings->friendship_matching, true);
        }

        if($settings)
        {
            $manual_subscription = json_decode($settings->manual_subscription, true);
            if(count($manual_subscription['image']))
            {
                $images = $manual_subscription['image'];
            }
            if(count($manual_subscription['descriptions']))
            {
                $descriptions = $manual_subscription['descriptions'];
            }
        }

        $user = user_detail();

       
        return view('web.index', compact('friendship', 'latest_members', 'user', 'images', 'descriptions', 'personalized', 'subscriptions', 'banners', 'states', 'genotypes', 'marital_status'));
    }










    public function index_search(Request $request)
    {   

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        if(!$request->membership_level)
        {
            return back();
        }

        $members = User::where('membership_level', $request->membership_level)->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1);

        if(!empty($request->looking_for))
        {
            $looking_for = $request->looking_for == 'man' ? 'male' : 'female';
        }

        if(!empty($request->looking_for && $request->i_am != $looking_for))
        {
            $members->where('users.gender', $looking_for);
        }

        if(!empty($request->i_am) && !empty($request->looking_for) && $request->i_am == $looking_for)
        {
           
            $members->where('users.gender', $request->i_am)->where('users.looking_for', $request->looking_for);
        }

        if($request->from_age)
        {
            $members->where('users.age', '>=', $request->from_age);
        }
        if($request->to_age)
        {
            $members->where('users.age', '<=', $request->to_age);
        }
        if($request->country)
        {
            $members->where('users.country', $request->country);
        }
        if($request->genotype)
        {
            $members->where('users.genotype', strtoupper($request->genotype));
        }
        if($request->hiv)
        {
            $members->where('users.HIV', strtoupper($request->hiv));
        }
        if($request->marital_status)
        {
            $members->where('users.marital_status', $request->marital_status);
        }
        if($request->religion)
        {
            $members->where('users.religion', $request->religion);
        }
        if($request->location)
        {
            $members->where('users.location', $request->location);
        }
        if($request->name)
        {
            $members->where('users.user_name', 'LIKE', "%{$request->name}%");
        }


        if($request->membership_level == 'basic')
        {
            $basics  = $members->orderBy('date_registered', 'DESC')->paginate(28);
            return view('web.basic', compact('basics', 'genotypes', 'marital_status', 'states'));
        }
        
        if($request->membership_level == 'premium')
        {
            $premiums  = $members->orderBy('date_registered', 'DESC')->paginate(28);
            return view('web.premium', compact('premiums', 'genotypes', 'marital_status', 'states'));
        }
        
        return redirect('/');
    }






    


    public function error_index()
    {
        return view('web.404');
    }
    



    public function login_index()
    {
        if(Auth::is_loggedin())
        {
            return redirect('/');
        }
        return view('web.login');
    }







    public function login_store(Request $request)
    {
        if(!$request->email_username){
            return back()->with('error', '*All field is required!');
        }

        $request->validate([
            'password' => 'required|min:6|max:12',
        ]);

        

        if(preg_match('/@/', $request->email_username))
        {
           $user = User::where('email', $request->email_username)->first();
        }else{
            $user = User::where('user_name', $request->email_username)->first();
        }

        if(!$user || !Hash::check($request->password, $user->password))
        {
            return back()->with('error', 'Wrong email, username or password, try again!');
        }

        if($user && $user->is_deactivated)
        {
            return back()->with('error', 'This account has been deactivated, contact the admin');
        }


        if($user && $user->is_suspend)
        {
            return back()->with('error', 'This account has been suspended, contact the admin');
        }

        if(preg_match('/@/', $user->user_name))
        {
            return redirect('/reset-username')->with('error', 'We noticed that your username has @ or looks like an email, please reset your username!');
        }
       
        if(Auth::login($user->email, $request->remember_me))
        {
            if(Session::has('old_url'))
            {
                $old_url = Session::get('old_url');
                Session::forget('old_url');
                return redirect($old_url);
            }
            if(Session::has('profile_url'))
            {
                $old_profile = Session::get('profile_url');
                Session::forget('profile_url');
                return redirect($old_profile);
            }
            return redirect('/');
        }
        return back()->with('error', 'Network error, try again!');
    }








    public function reset_username_index()
    {
        return view('web.reset-username');
    }







    public function reset_username_store(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if(!$check)
        {
            return back()->with('error', '*Email '.$request->email.' does not exist!'); 
        }

        $token = password_hash(uniqid(), PASSWORD_DEFAULT);
        $check = DB::table('reset_usernames')->where('email', $request->email)->first();
        if($check)
        {
            DB::table('reset_usernames')->where('email', $request->email)->delete();
        }

        $create = DB::table('reset_usernames')->insert([
            'email' => $request->email,
            'token' => $token
        ]);

        if($create)
        {
            $url = url('/new-username?token='.$token);
            Mail::to($request->email)->send(new NewUsernameMailer($url));
        }

        return back()->with('success', 'Username reset token has been sent to your email.');
    }
    




    public function new_username_index(Request $request)
    {
        if(!$request->token){
            return redirect('/404');
        }

        $check = DB::table('reset_usernames')->where('token', $request->token)->first();
        if(!$check){
            return redirect('/404');
        }

        return view('web.new-username');
    }







    
    public function new_username_store(Request $request)
    {
        if(!$request->token)
        {
            return redirect('/404');
        }

        $request->validate([
            'user_name' => 'required|min:3|max:50|unique:users',
        ]);

        if(preg_match('/@/', $request->user_name))
        {
           return back()->with('error', '*Must not use @ or an email address');
        }

        $token = DB::table('reset_usernames')->where('token', $request->token)->first();
        if($token)
        {
            $update = User::where('email', $token->email)->first();
            if($update)
            {
                $update->user_name = $request->user_name;
                if($update->save())
                {
                    DB::table('reset_usernames')->where('token', $request->token)->delete();
                    return redirect('/login')->with('success', 'Username reset successful, Now you can login');
                }
            }
        }

        return view('web.new-username')->with('error', 'Network error, try again later!');
    }
    




    
    public function forgot_password_index()
    {
        return view('web.forgot-password');
    }






    public function forgot_password_store(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if(!$check)
        {
            return back()->with('error', '*Email '.$request->email.' does not exist!'); 
        }

        $token = password_hash(uniqid(), PASSWORD_DEFAULT);
        $check = DB::table('password_resets')->where('email', $request->email)->first();
        if($check)
        {
            DB::table('password_resets')->where('email', $request->email)->delete();
        }

        $create = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token
        ]);

        if($create)
        {
            $url = url('/new-password?token='.$token);
            Mail::to($request->email)->send(new UserMail($url));
        }
        
        return back()->with('success', 'Password reset token has been sent to your email.');
    }
    
    






    
    public function forgot_password_message_index()
    {
        $app = DB::table('settings')->where('id', 1)->first(); //app settings

        return view('web.forgot-password-message', compact('app'));
    }







    public function new_password_index(Request $request)
    {
        if(!$request->token){
            return redirect('/404');
        }

        $check = DB::table('password_resets')->where('token', $request->token)->first();
        if(!$check){
            return redirect('/404');
        }

        return view('web.new-password');
    }






    public function new_password_update(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|max:12|same:confirm_password',
            'confirm_password' => 'required|min:6|max:12',
        ]);
        if(!$request->token)
        {
            return redirect('/404');
        }

        $token = DB::table('password_resets')->where('token', $request->token)->first();
        if($token)
        {
            $update = User::where('email', $token->email)->first();
            if($update)
            {
                $update->password = hash::make($request->new_password);
                if($update->save())
                {
                    DB::table('password_resets')->where('token', $request->token)->delete();
                    return redirect('/login')->with('success', 'Password reset successful, Now you can login');
                }
            }
        }

        return view('web.new-password')->with('error', 'Network error, try again later!');
    }
    







    
    public function logout()
    {
        if(Auth::logout())
        {
            return redirect('/');
        }
        return back();
    }
    








    public function register_index()
    {
        if(Auth::is_loggedin())
        {
            return redirect('/');
        }
        $sliders = DB::table('form_banners')->get();

        return view('web.register', compact('sliders'));
    }









    public function register_store(Request $request)
    {      
        return redirect('/404');

        $request->validate([
            'user_name' => 'required|min:3|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12|same:confirm_password',
            'confirm_password' => 'required|min:6|max:12',
            'phone' => 'required|min:11|max:20',
            'gender' => 'required'
        ]);

        if(!is_numeric($request->phone))
        {
            return back()->with('error', 'Wrong phone number format!');
        }

        $register = User::create([
                'user_name' => $request->user_name,
                'email' => strtolower($request->email),
                'gender' => $request->gender,
                'phone' => $request->phone,
                'password' => hash::make($request->password),
                'membership_level' => 'basic',
            ]);

        if(Auth::login($request->email))
        {
            $id = Auth::user('id');
            if($register)
            {
                //send notification to admin
                DB::table('notifications')->insert([
                        'notification_from' => $id,
                        'notification_to' => 'admin',
                        'title' => $request->user_name,
                        'type' => 'register',
                        'description' => $request->user_name.' has just registered with lagosmatchmaker',
                        'link' => 'admin/member-detail/'.$id,
                ]);
            }
            
            return redirect('/profile/'.$id)->with('success', 'Account created successfully');
        }
    }








    public function profile_index()
    {
        return view('web.profile');
    }









    public function profile_detail($id)
    {
        $gender = null;
        $was_liked = false;
        $you_liked = false;
       
        $user = User::where('id', $id)->first(); //get user detail
      
        if(!$user)
        {
            return redirect('/404');
        }

        $reports = DB::table('reports')->where('is_featured', 1)->get(); // aget all reports
        
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states
        
        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $ethnicities = DB::table('ethnicities')->where('is_featured', 1)->get(); //get all ethnicities options
   
        $heights = DB::table('height')->where('is_featured', 1)->get(); //get all height options

        $body_types = DB::table('body_type')->where('is_featured', 1)->get(); //get all body type options

        $weights = DB::table('weight')->where('is_featured', 1)->get(); //get all weight options

        $smokings = DB::table('smoking')->where('is_featured', 1)->get(); //get all smoking options

        $drinkings = DB::table('drinking')->where('is_featured', 1)->get(); //get all drinking options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $display_name = $user->display_name ? $user->display_name : $user->user_name; //user name

        
        
        if($user->gender)
        {
            if($user->gender == 'male')
            {
                $gender = 'man';
            }
            if($user->gender == 'female')
            {
                $gender = 'woman';
            }
        }


        if(Auth::user('id') != $id)
        {
            $you_liked = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $id)->first(); //you liked this user
            $was_liked = DB::table('likes')->where('initiator_id', $id)->where('acceptor_id', Auth::user('id'))->first(); // this user liked you
        }

        $is_friend = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $id)->where('is_accept', 1)->orWhere('initiator_id', $id)->where('acceptor_id', Auth::user('id'))->where('is_accept', 1)->first();

        $is_blocked = Block::where('blocker', Auth::user('id'))->where('blocked_member', $id)->first();

        return view('web.profile', compact('is_blocked', 'is_friend', 'reports', 'marital_status', 'was_liked', 'you_liked','states', 'user', 'display_name', 'gender', 'smokings', 'drinkings', 'heights', 'weights', 'body_types', 'ethnicities', 'genotypes'));
    }







    public function premium_index(Request $request)
    {   
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $members = User::where('membership_level', 'premium')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1);
        

        if($request->query('membership_level'))
        {
            if($request->looking_for)
            {
                $members->where('users.gender', $request->looking_for);
            }
            if($request->from_age)
            {
                $members->where('users.age', '>=', $request->from_age);
            }
            if($request->country)
            {
                $members->where('users.country', $request->country);
            }
            if($request->to_age)
            {
                $members->where('users.age', '<=', $request->to_age);
            }
            if($request->genotype)
            {
                $members->where('users.genotype', $request->genotype);
            }
            if($request->hiv)
            {
                $members->where('users.HIV', strtoupper($request->hiv));
            }
            if($request->marital_status)
            {
                $members->where('users.marital_status', $request->marital_status);
            }
            if($request->religion)
            {
                $members->where('users.religion', $request->religion);
            }
            if($request->location)
            {
                $members->where('users.location', $request->location);
            }
            if($request->name)
            {
                $members->where('users.user_name', 'LIKE', "%{$request->name}%");
            }
        }

        $premiums = $members->paginate(28);
        
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function premium_men()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $premiums = User::where('gender', 'male')->where('membership_level', 'premium')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->paginate(28);//get all male premium members
       
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function premium_women()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $premiums = User::where('gender', 'female')->where('membership_level', 'premium')->where('is_approved', 1)->where('is_deactivated', 0)->paginate(28);//get all female premium members

        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function message_index(Request $request)
    {
        if(!Auth::is_loggedin())
        {
            return redirect('/login');
        }

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states
        
        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $ethnicities = DB::table('ethnicities')->where('is_featured', 1)->get(); //get all ethnicities options
   
        $heights = DB::table('height')->where('is_featured', 1)->get(); //get all height options

        $body_types = DB::table('body_type')->where('is_featured', 1)->get(); //get all body type options

        $weights = DB::table('weight')->where('is_featured', 1)->get(); //get all weight options

        $smokings = DB::table('smoking')->where('is_featured', 1)->get(); //get all smoking options

        $drinkings = DB::table('drinking')->where('is_featured', 1)->get(); //get all drinking options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options


        $users = [];
        $user_ids = [];
        $chats = Chat::where('sender_id', Auth::user('id'))->where('sender_delete', 0)->orWhere('receiver_id', Auth::user('id'))->where('receiver_delete', 0)->get();
        foreach($chats as $chat)
        {
            if($chat->sender_id !== Auth::user('id'))
            {
                if(!in_array($chat->sender_id, $user_ids))
                {
                    $user_ids[] = $chat->sender_id;
                }
            }
            if($chat->receiver_id !== Auth::user('id'))
            {
                if(!in_array($chat->receiver_id, $user_ids))
                {
                    $user_ids[] = $chat->receiver_id;
                }
            }
        }

        if(count($user_ids))
        {
            foreach($user_ids as $user_id)
            {
                $users[] =  User::where('id', $user_id)->first();
            }
        }

        return view('web.message', compact('weights', 'heights', 'smokings', 'drinkings', 'ethnicities', 'body_types', 'users','marital_status', 'genotypes', 'states'));
    }







    public function chat_index($receiver_id)
    {
        if(!Auth::is_loggedin())
        {
            return redirect('/');
        }
        
        $messages = $this->get_users_message(); //get users that you sharing chats with

        $receiver = User::where('id', $receiver_id)->first();//get user detail;

        $state = $this->check_for_friendship($receiver);
        if($state)
        {
            return redirect('/')->with('warning', 'You and '.$receiver->user_name.' are not matched, Match with '.$receiver->user_name.' to be able to chat!');
        }

        $display_name = $receiver->display_name ? $receiver->display_name : $receiver->user_name; //user name

        $profile_image =  $receiver->gender == 'male' ? 'M' : 'F'; //get user image

        // set sender chat to seen
        $seen_chats = Chat::where('sender_id', $receiver_id)->where('is_seen', 0)->get();
        if(count($seen_chats))
        {
            foreach($seen_chats as $seen_chat)
            {
                Chat::where('chat_id', $seen_chat->chat_id)->update([
                    'is_seen' => 1
                ]);
            }
        }

        $chats = [];
        $chat_token = null;
    
        $check = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->orWhere('sender_id', $receiver_id)->where('receiver_id', Auth::user('id'))->first();
        if($check)
        {
            $chat_token = $check->chat_token;
        }
        

        return view('web.chat', compact('chat_token', 'receiver', 'display_name', 'profile_image', 'messages'));
    }











    public function check_for_friendship($receiver)
    {
        $is_friend = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $receiver->id)
                        ->where('is_accept', 1)->orWhere('initiator_id', $receiver->id)->where('acceptor_id', Auth::user('id'))->where('is_accept', 1)->first();
        if(!$is_friend)
        {
            return true;
        }    
        return false;
    }
    







    public function get_users_message()
    {
        $user_ids = [];
        $messages = [];

        $chats = Chat::Where('receiver_id', Auth::user('id'))->where('receiver_delete', 0)->get();
        
        $charts_2 = Chat::Where('sender_id', Auth::user('id'))->where('sender_delete', 0)->get();
        
        // get ID of users who sent message to you
        foreach($chats as $chat)
        {
            if(!in_array($chat->sender_id, $user_ids))
            {
                $user_ids[] = $chat->sender_id;
            }
        }
        foreach($charts_2 as $chat)
        {
            if(!in_array($chat->receiver_id, $user_ids))
            {
                $user_ids[] = $chat->receiver_id;
            }
        }

        // get all users who sent message to you
        if(count($user_ids))
        {
            foreach($user_ids as $user_id)
            {
                $messages[] = User::where('id', $user_id)->first();
            }
        }

        return $messages;
    }











    public function how_it_works_index()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $how_it_works = DB::table('how_it_works')->get(); //get all how it works

        return view('web.how-it-works', compact('how_it_works', 'marital_status', 'genotypes', 'states'));
    }










    public function friends_index()
    {
        if(!Auth::is_loggedin())
        {
            return redirect('/login');
        }

        $friends_request = DB::table('likes')->where('acceptor_id', Auth::user('id'))->where('is_accept', 0)
                            ->leftJoin('users', 'likes.initiator_id', 'users.id')->get();

        $friend = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('is_accept', 1)->orWhere('acceptor_id', Auth::user('id'))->where('is_accept', 1);
        $friends_count = $friend->get();
        $friends = $friend->paginate(50);

        return view('web.friends', compact('friends', 'friends_count' ,'friends_request'));
    }
    








    public function basic_idex(Request $request)
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options


        $members = User::where('membership_level', 'basic')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1);
        


        if($request->query('membership_level'))
        {
            if($request->looking_for)
            {
                $members->where('users.gender', $request->looking_for);
            }
            if($request->from_age)
            {
                $members->where('users.age', '>=', $request->from_age);
            }
            if($request->to_age)
            {
                $members->where('users.age', '<=', $request->to_age);
            }
            if($request->country)
            {
                $members->where('users.country', $request->country);
            }
            if($request->genotype)
            {
                $members->where('users.genotype', $request->genotype);
            }
            if($request->hiv)
            {
                $members->where('users.HIV', strtoupper($request->hiv));
            }
            if($request->marital_status)
            {
                $members->where('users.marital_status', $request->marital_status);
            }
            if($request->religion)
            {
                $members->where('users.religion', $request->religion);
            }
            if($request->location)
            {
                $members->where('users.location', $request->location);
            }
            if($request->name)
            {
                $members->where('users.user_name', 'LIKE', "%{$request->name}%");
            }
        }
        

        $basics = $members->paginate(28);


        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }
    







    public function basic_men()
    {
        $basics = User::where('gender', 'male')->where('membership_level', 'basic')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->paginate(28);

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }







    public function basic_women()
    {
        $basics = User::where('gender', 'female')->where('membership_level', 'basic')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->paginate(28);

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }









    public function subscription_index()
    {
        $subscriptions = DB::table('subscriptions')->where('sub_is_featured', 1)->get(); //get all subscriptions options

        $images = null;
        $descriptions = null;
        $personalized = null;

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            $manual_subscription = json_decode($settings->manual_subscription, true);
            if(count($manual_subscription['image']))
            {
                $images = $manual_subscription['image'];
            }
            if(count($manual_subscription['descriptions']))
            {
                $descriptions = $manual_subscription['descriptions'];
            }
        }

        if($settings && $settings->personalized_match)
        {
            $personalized = json_decode($settings->personalized_match, true);
        }

        return view('web.subscription', compact('subscriptions', 'images', 'descriptions', 'personalized'));
    }






    public function subscription_store(Request $request)
    {
        if(!Session::has('subscription'))
        {
            Session::forget('user');
            return redirect('/login');
        }else{
            $url = url('/success');
            $user = $this->user_detail();
            $sub_id = Session::get('subscription');
            $subscription = DB::table('subscriptions')->where('sub_id', $sub_id)->where('sub_is_featured', 1)->first();
            
            $paystack = Paystack::initialize($user->email, $subscription->amount, $url);

            return redirect($paystack);
        }
    }









    public function success_index(Request $request)
    {
        if(!Session::has('subscription') || !$request->reference)
        {
            return redirect('/');
        }
 
        $user = $this->user_detail();
        $sub_id = Session::get('subscription');

        $display_name = $user->display_name ? $user->display_name : $user->user_name; //get user name
        $sub = DB::table('subscriptions')->where('sub_id', $sub_id)->first();
        $expiry = date('Y-m-d H:i:s', strtotime('+'.$sub->duration));

        // update and close existing user subscription
        DB::table('user_subscriptions')->where('user_id', Auth::user('id'))->where('is_expired', 0)->update([
                    'is_expired' => 1,
                    'date_ended' => date('Y-m-d H:i:s')
        ]);

        $create = DB::table('user_subscriptions')->insert([
                        'reference' => $request->reference,  
                        'user_id' => $user->id,      
                        'subscription_id' => $sub->sub_id,  
                        'duration' => $sub->duration,  
                        'amount' => $sub->amount,  
                        'subscription_type' => $sub->type,  
                        'start_date' => date('Y-m-d H:i:s'),
                        'end_date' => $expiry,  
                    ]);
        
        if($create)
        {
            $this_user = User::where('id', Auth::user('id'))->first();
            $this_user->membership_level = $sub->type;
            $this_user->save();

            $this->subscription_notification($sub); //send a notification to the admin

            Session::forget('subscription');

            $back_link = '/';
            if(Session::has('profile_url'))
            {
                $back_link = Session::get('profile_url');
                Session::forget('profile_url');
            }
        }
        
        return view('web.success', compact('display_name', 'back_link'));
    }
    





    public function subscription_notification($sub)
    {
        DB::table('notifications')->insert([
            'notification_from' => Auth::user('id'),
            'notification_to' => 'admin',
            'title' => Auth::user('user_name'),
            'description' => Auth::user('user_name').' has subscribed to '.ucfirst($sub->type).' plan',
            'link' => 'admin/subscription-history/'.Auth::user('id')      
        ]);
    }






    public function user_detail(){
        $user = User::where('id', Auth::user('id'))->where('email', Auth::user('email'))->first(); //get user detail
        return $user;
    }






    public function unsubescribe_newsletter()
    {
       return view('web.unsubscribe-newsletter');
    }
    


    public function contact_index(){
        return view('web.contact');
    }
     
    


    public function contact_store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'comment' => 'required|min:6|max:5000|',
        ]);
        
        $create = ContactUs::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        if($create)
        {
            return back()->with('success', 'Message sent successfully');
        }
        return back()->with('error', 'Network error, try again later');
    }
     
  



    public function settings_index(){
        if(!Auth::is_loggedin())
        {
            return redirect('/');
        }

        $blocked = Block::where('blocker', Auth::user('id'))->leftJoin('users', 'blocks.blocked_member', '=', 'users.id')->paginate(5);

        return view('web.settings', compact('blocked'));
    }
    





    public function update_username_update(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:100',
        ]);

        if(preg_match('/@/', $request->username))
        {
            return back()->with('error-username', '*Must not use @ or an email address');
        }

        $user = User::where('id', Auth::user('id'))->where('email', Auth::user('email'))->where('user_name', $request->username)->first();
        if(!$user)
        {
            $check = User::where('user_name', $request->username)->get();
            if(count($check))
            {
                return back()->with('error-username', '*Username already exists');
            }
        }


        $current_user = User::where('id', Auth::user('id'))->where('email', Auth::user('email'))->first();
        $current_user->user_name = $request->username;
        if($current_user->save())
        {
            Auth::login(Auth::user('email'));
            return back()->with('success-username', 'User name updated successfully');
        }

        return back()->with('error-username', 'Network error, try again later');
    }
    






    public function change_password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6|max:12',
            'new_password' => 'required|min:6|max:12|same:confirm_password',
            'confirm_password' => 'required|min:3|max:100',
        ]);

        $user = User::where('id', Auth::user('id'))->where('email', Auth::user('email'))->first();
        if(!$user || !Hash::check($request->old_password, $user->password))
        {
            return back()->with('error-password', 'Wrong old password, try again!');
        }

        if($user)
        {
            $user->password = hash::make($request->new_password);
            $user->save();
            return back()->with('success-password', 'Password updated successfully');
        }



        return back()->with('error-password', 'Network error, try again later');
    }
    








    public function report_index()
    {
        return view('web.report');
    }
    






    public function about_us_index()
    {
        $about_us = DB::table('settings')->where('id', 1)->first();

        return view('web.about-us', compact('about_us'));
    }
    





    public function terms_index()
    {
        $terms = DB::table('settings')->where('id', 1)->first();

        return view('web.terms', compact('terms'));
    }






    public function privacy_policy_index()
    {
        $privacy = DB::table('settings')->where('id', 1)->first();

        return view('web.privacy-policy', compact('privacy'));
    }
    





    public function manual_payment_index()
    {
        $images = null;
        $descriptions = null;
        $personalized = null;
        
        if(!Auth::is_loggedin())
        {
            return redirect('/login');
        }

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            $manual_subscription = json_decode($settings->manual_subscription, true);
            if(count($manual_subscription['image']))
            {
                $images = $manual_subscription['image'];
            }
            if(count($manual_subscription['descriptions']))
            {
                $descriptions = $manual_subscription['descriptions'];
            }
        }

        if($settings && $settings->personalized_match)
        {
            $personalized = json_decode($settings->personalized_match, true);
        }

        $user = User::where('id', Auth::user('id'))->first();
        if($user->membership_level == 'premium' && !$user->id_card)
        {
            Session::flash('manual_payment', true);
        }

        $premium = DB::table('subscriptions')->where('type', 'premium')->first();

        return view('web.manual-payment', compact('premium', 'personalized', 'descriptions', 'images'));
    }
    

    
    // end
}
