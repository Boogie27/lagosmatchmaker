<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Auth;
use App\Models\Paystack;
use App\Models\Chat;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Session;
use Cookie;
use Mail;


use App\Jobs\SendEmailJob;
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
       
        $images = null;
        $personalized = null;
        $descriptions = null;

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings && $settings->personalized_match)
        {
            $personalized = json_decode($settings->personalized_match, true);
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
       
        return view('web.index', compact('images', 'descriptions', 'personalized', 'subscriptions', 'banners', 'states', 'genotypes', 'marital_status'));
    }










    public function index_search(Request $request)
    {   

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

       

         $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub && $basic_sub->amount == 0 && $request->membership_level == 'basic')
        {
            $members = User::where('membership_level', 'basic')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1);
        }

        if($basic_sub && $basic_sub->amount > 0 || $request->membership_level == 'premium')
        {
            $members = DB::table('user_subscriptions')->leftJoin('users', 'user_subscriptions.user_id', '=', 'users.id')
                        ->where('user_subscriptions.subscription_type', $request->membership_level)->where('user_subscriptions.is_expired', 0)->where('users.is_suspend', 0)->where('users.is_deactivated', 0)
                        ->where('users.is_approved', 1);
        }


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
        if($request->genotype)
        {
            $members->where('users.genotype', $request->genotype);
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
            $members->where('users.display_name', 'LIKE', "%{$request->name}%");
        }


        if($request->membership_level == 'basic')
        {
            $basics  = $members->paginate(25);
            return view('web.basic', compact('basics', 'genotypes', 'marital_status', 'states'));
        }
        
        if($request->membership_level == 'premium')
        {
            $premiums  = $members->paginate(25);
            return view('web.premium', compact('premiums', 'genotypes', 'marital_status', 'states'));
        }
        
        return redirect('web.index');
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return back()->with('error', 'Wrong email or password, try again!');
        }

        if($user && $user->is_deactivated)
        {
            return back()->with('error', 'This account has been deactivated, contact the admin');
        }


        if($user && $user->is_suspend)
        {
            return back()->with('error', 'This account has been suspended, contact the admin');
        }

        if(Auth::login($request->email, $request->remember_me))
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
            // Mail::to($request->email)->send(new UserMail($url));
            SendEmailJob::dispatch($request->email, $url)->delay(now()->addSeconds(5));
        }

      
        
        return back()->with('success', 'Password reset token has been sent to your email.');
    }
    
    




    // public function forgot_password_store(Request $request)
    // {
    //     $token = password_hash(uniqid(), PASSWORD_DEFAULT);
    //     $url = url('/new-password?token='.$token);

    //     SendEmailJob::dispatch($request->email, $url)->delay(now()->addSeconds(5));

    //     return back()->with('success', 'Password reset token has been sent to your email.');
    // }



    
    public function forgot_password_message_index()
    {
        $app = DB::table('settings')->where('id', 1)->first(); //app settings

        return view('web.forgot-password-message', compact('app'));
    }







    public function new_password_index()
    {
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
            return redirect('/');
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

        return view('web.register');
    }









    public function register_store(Request $request)
    {       
        $request->validate([
            'user_name' => 'required|min:3|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12|same:confirm_password',
            'confirm_password' => 'required|min:6|max:12',
            'gender' => 'required'
        ]);
        
        $register = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'gender' => $request->gender,
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
        $was_liked = false;
        $you_liked = false;

        $user = User::where('id', $id)->first(); //get user detail
        
        if(!$user)
        {
            return redirect('web/404');
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

        $display_name = $user->display_name ? $user->display_name : $user->user_name; //user name

        $gender = $user->gender == 'male' ? 'man' : 'woman'; // gender

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        if(Auth::user('id') != $id)
        {
            $you_liked = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $id)->first(); //you liked this user
            $was_liked = DB::table('likes')->where('initiator_id', $id)->where('acceptor_id', Auth::user('id'))->first(); // this user liked you
        }

        $is_friend = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $id)->where('is_accept', 1)->orWhere('initiator_id', $id)->where('acceptor_id', Auth::user('id'))->where('is_accept', 1)->first();


        return view('web.profile', compact('is_friend', 'reports', 'marital_status', 'was_liked', 'you_liked','states', 'user', 'display_name', 'gender', 'smokings', 'drinkings', 'heights', 'weights', 'body_types', 'ethnicities', 'genotypes'));
    }







    public function premium_index(Request $request)
    {   
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $members = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'premium')->where('users.membership_level', 'premium')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1);//get all premium members

        

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
            if($request->genotype)
            {
                $members->where('users.genotype', $request->genotype);
            }
            if($request->marital_status)
            {
                $members->where('users.marital_status', $request->marital_status);
            }
            if($request->membership_level)
            {
                $members->where('users.membership_level', $request->membership_level);
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
                $members->where('users.display_name', 'LIKE', "%{$request->name}%");
            }
        }
        


        $premiums = $members->paginate(25);
        
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function premium_men()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $premiums = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'premium')->where('users.membership_level', 'premium')->where('users.gender', 'male')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->paginate(25);//get all male premium members
       
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function premium_women()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $premiums = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'premium')->where('users.membership_level', 'premium')->where('users.gender', 'female')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->paginate(25);//get all female premium members
       
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

        return view('web.message', compact('users','marital_status', 'genotypes', 'states'));
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
           

            $chat = Chat::where('sender_id', Auth::user('id'))->where('receiver_id', $receiver_id)->where('sender_delete', 0)
                            ->orWhere(function($query) use ($receiver_id){
                            $query->where('receiver_id', Auth::user('id'))->where('sender_id', $receiver_id)->where('receiver_delete', 0);
                         });
            $count = count($chat->get());

            if($count > 0 && $count < 25)
            {
                $chats = $chat->limit($count)->get();
            }else{
                $take = 25;
                $skip = $count - $take;
                $chats = $chat->skip($skip)->take($take)->get();
            }

            // dd($chats);

            // dd($count);
        }
        

        return view('web.chat', compact('chat_token', 'receiver', 'display_name', 'profile_image', 'chats', 'messages'));
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
        
        $charts_2 = Chat::Where('sender_id', Auth::user('id'))->where('receiver_delete', 0)->get();
        
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

        $friends = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('is_accept', 1)->orWhere('acceptor_id', Auth::user('id'))->where('is_accept', 1)->paginate(25);

        return view('web.friends', compact('friends', 'friends_request'));
    }
    








    public function basic_idex(Request $request)
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options


        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub->amount == 0)
        {
            $members = User::where('membership_level', 'basic')->where('is_deactivated', 0)->where('is_suspend', 0)->where('is_approved', 0); //get all basic  when its free         
        }

        if($basic_sub->amount > 0)
        {
            $members= DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'basic')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1);//get basic when its not free  
        }


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
            if($request->genotype)
            {
                $members->where('users.genotype', $request->genotype);
            }
            if($request->marital_status)
            {
                $members->where('users.marital_status', $request->marital_status);
            }
            if($request->membership_level)
            {
                $members->where('users.membership_level', $request->membership_level);
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
                $members->where('users.display_name', 'LIKE', "%{$request->name}%");
            }
        }
        

        $basics = $members->paginate(25);


        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }
    







    public function basic_men()
    {
        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub->amount == 0)
        {
            $basics = User::where('gender', 'male')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->paginate(25); // get all basic men
        }
       
        if($basic_sub->amount > 0)
        {
            $basics= DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'basic')->where('users.gender', 'male')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->paginate(25);//get basic when its not free  
        }

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }







    public function basic_women()
    {
        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub->amount == 0)
        {
            $basics = User::where('gender', 'female')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->paginate(25); // get all basic women
        }
       
        if($basic_sub->amount > 0)
        {
            $basics= DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'basic')->where('users.gender', 'female')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->paginate(25);//get basic when its not free  
        }

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
        return view('web.settings');
    }
    





    public function update_username_update(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:100',
        ]);

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
    





    public function manual_index()
    {
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

        return view('web.manual-payment', compact('personalized', 'descriptions', 'images'));
    }
    

    
    // end
}
