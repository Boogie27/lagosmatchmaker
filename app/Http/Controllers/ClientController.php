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
// use Validator;


class ClientController extends Controller
{
    public function index()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

       return view('web.index', compact('states', 'genotypes', 'marital_status'));
    }







    public function index_search(Request $request)
    {   
        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub && $basic_sub->amount == 0)
        {
            $members = User::where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1);
        }else{
            $members = DB::table('user_subscriptions')->leftJoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('users.is_suspend', 0)->where('users.is_deactivated', 0)->where('users.is_approved', 1);
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


        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        
        if($request->membership_level == 'basic')
        {
            $basics  = $members->get();
            return view('web.basic', compact('basics', 'genotypes', 'marital_status', 'states'));
        }
        if($request->membership_level == 'premium')
        {
            $premiums  = $members->get();
            return view('web.premium', compact('premiums', 'genotypes', 'marital_status', 'states'));
        }
        
        return redirect('web.index');
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
    



    public function new_password_index()
    {
        return view('web.new-password');
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
        
        User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => hash::make($request->password),
            'membership_level' => 'basic',
        ]);

        if(Auth::login($request->email))
        {
            $id = Auth::user('id');
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

        $user = User::where('id', $id)->where('is_deactivated', 0)->first(); //get user detail
        
        if(!$user)
        {
            return redirect('/');
        }

        $reports = DB::table('reports')->where('is_featured', 1)->get(); // aget all reports
        
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $avatars = DB::table('avatars')->where('is_featured', 1)->get(); //get all avatars
        
        $banners = DB::table('banners')->where('is_featured', 1)->get(); //get all banners

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $ethnicities = DB::table('ethnicities')->where('is_featured', 1)->get(); //get all ethnicities options
   
        $heights = DB::table('height')->where('is_featured', 1)->get(); //get all height options

        $body_types = DB::table('body_type')->where('is_featured', 1)->get(); //get all body type options

        $weights = DB::table('weight')->where('is_featured', 1)->get(); //get all weight options

        $smokings = DB::table('smoking')->where('is_featured', 1)->get(); //get all smoking options

        $drinkings = DB::table('drinking')->where('is_featured', 1)->get(); //get all drinking options

        $display_name = $user->display_name ? $user->display_name : $user->user_name; //user name

        $gender = $user->gender == 'male' ? 'man' : 'woman'; // gender

        $profile_image =  avatar($user->display_image, $user->gender); //get user image

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $you_may_like = User::where('is_approved', 1)->where('is_deactivated', 0)->inRandomOrder()->limit(9)->get();

        if(Auth::user('id') != $id)
        {
            $you_liked = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $id)->first(); //you liked this user
            $was_liked = DB::table('likes')->where('initiator_id', $id)->where('acceptor_id', Auth::user('id'))->first(); // this user liked you
        }



        return view('web.profile', compact('reports', 'banners', 'marital_status', 'was_liked', 'you_liked','states', 'user', 'profile_image', 'display_name', 'gender', 'you_may_like', 'smokings', 'drinkings', 'heights', 'weights', 'body_types', 'ethnicities', 'genotypes', 'avatars'));
    }







    public function premium_index(Request $request)
    {   
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $members = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'premium')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1);//get all premium members

        

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
        


        $premiums = $members->get();
        
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function premium_men()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $premiums = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'premium')->where('users.gender', 'male')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->get();//get all male premium members
       
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function premium_women()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        $premiums = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'premium')->where('users.gender', 'female')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->get();//get all female premium members
       
        return view('web.premium', compact('premiums', 'states', 'genotypes', 'marital_status'));
    }







    public function message_index()
    {
        if(!Auth::is_loggedin())
        {
            return redirect('/login');
        }

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options


        $user_ids = [];
        $messages = [];
        $chats = Chat::Where('receiver_id', Auth::user('id'))->where('receiver_delete', 0)->get();
         // get ID of users who sent message to you
        foreach($chats as $chat)
        {
            if(!in_array($chat->sender_id, $user_ids))
            {
                $user_ids[] = $chat->sender_id;
            }
        }

        // get all users who sent message to you
        if(count($user_ids))
        {
            foreach($user_ids as $user_id)
            {
                $messages[] = User::where('id', $user_id)->where('is_deactivated', 0)->where('is_suspend', 0)->where('is_approved', 1)->first();
            }
        }



        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub && $basic_sub->amount == 0)
        {
            $may_likes = User::where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->inRandomOrder()->limit(8)->get();
        }else{
            $may_likes = DB::table('user_subscriptions')->leftJoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('users.is_suspend', 0)->where('users.is_deactivated', 0)->where('users.is_approved', 1)->inRandomOrder()->limit(8)->get();
        }
        

        return view('web.message', compact('messages', 'may_likes','marital_status', 'genotypes', 'states'));
    }







    public function chat_index($receiver_id)
    {
        if(!Auth::is_loggedin())
        {
            return redirect('/login');
        }

        // $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        // if($basic_sub->amount == 0)
        // {
        //     $receiver = User::where('id', $receiver_id)->where('is_deactivated', 0)->where('is_suspend', 0)->where('is_approved', 1)->first();//get user detail;
        // }

        // if($basic_sub->amount > 0)
        // {
        //     $receiver = DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('users.id', $receiver_id)->where('user_subscriptions.subscription_type', 'basic')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->first();//get user chats when its not free  
        // }

        // if(!$receiver)
        // {
        //     return redirect('/');
        // }
        $receiver = User::where('id', $receiver_id)->where('is_deactivated', 0)->where('is_suspend', 0)->where('is_approved', 1)->first();//get user detail;

        $chats = null;

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

        
        $chat_token_1 = 'chat_'.Auth::user('id').'_'.$receiver_id;
        $chat_token_2 = 'chat_'.$receiver_id.'_'.Auth::user('id');

        $chats = Chat::where('chat_token', $chat_token_1)->orWhere('chat_token', $chat_token_2)->get();

        return view('web.chat', compact('receiver', 'display_name', 'profile_image', 'chats'));
    }
    







    public function how_it_works_index()
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        return view('web.how-it-works', compact('marital_status', 'genotypes', 'states'));
    }





    public function friends_index()
    {
        $friends = [];
        $initiators = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('is_accept', 1)->get();
        $acceptors = DB::table('likes')->where('acceptor_id', Auth::user('id'))->where('is_accept', 1)->get();

        if(count($initiators))
        {
            foreach($initiators as $initiator)
            {
                $user_initiator = User::where('id', $initiator->acceptor_id)->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->first();
                if($user_initiator)
                {
                    $friends[] = $user_initiator;
                }
            }
        }
        if(count($acceptors))
        {
            foreach($acceptors as $acceptor)
            {
                $user_acceptor = User::where('id', $acceptor->initiator_id)->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->first();
                if($user_acceptor)
                {
                    $friends[] = $user_acceptor;
                }
            }
        }

        return view('web.friends', compact('friends'));
    }
    








    public function basic_idex(Request $request)
    {
        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options


        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub->amount == 0)
        {
            $members = User::where('membership_level', 'basic')->where('is_deactivated', 0)->where('is_suspend', 0)->where('is_approved', 1); //get all basic  when its free         
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
        

        $basics = $members->get();


        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }
    







    public function basic_men()
    {
        $basic_sub = DB::table('subscriptions')->where('type', 'basic')->first();
        if($basic_sub->amount == 0)
        {
            $basics = User::where('gender', 'male')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->get(); // get all basic men
        }
       
        if($basic_sub->amount > 0)
        {
            $basics= DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'basic')->where('users.gender', 'male')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->get();//get basic when its not free  
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
            $basics = User::where('gender', 'female')->where('is_suspend', 0)->where('is_deactivated', 0)->where('is_approved', 1)->get(); // get all basic women
        }
       
        if($basic_sub->amount > 0)
        {
            $basics= DB::table('user_subscriptions')->leftjoin('users', 'user_subscriptions.user_id', '=', 'users.id')->where('user_subscriptions.is_expired', 0)->where('user_subscriptions.subscription_type', 'basic')->where('users.gender', 'female')->where('users.is_deactivated', 0)->where('users.is_suspend', 0)->where('users.is_approved', 1)->get();//get basic when its not free  
        }

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states

        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options

        return view('web.basic', compact('basics', 'states', 'genotypes', 'marital_status'));
    }









    public function subscription_index()
    {
        $subscriptions = DB::table('subscriptions')->where('sub_is_featured', 1)->get(); //get all subscriptions options

        return view('web.subscription', compact('subscriptions'));
    }






    public function subscription_store(Request $request){
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
                        'amount' => $sub->amount,  
                        'subscription_type' => $sub->type,  
                        'end_date' => $expiry,  
                    ]);
        if($create)
        {
            $this_user = User::where('id', Auth::user('id'))->first();
            $this_user->membership_level = $sub->type;
            $this_user->save();

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
    






    public function user_detail(){
        $user = User::where('id', Auth::user('id'))->where('email', Auth::user('email'))->where('is_deactivated', 0)->first(); //get user detail
        return $user;
    }






    public function unsubescribe_newsletter(){
       return view('web.unsubscribe-newsletter');
    }
    


    public function contact_index(){
        return view('web.contact');
    }
     
    


    public function contact_store(Request $request){
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
    





    public function update_username_update(Request $request){
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
    






    public function change_password_update(Request $request){
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
    




    public function report_index(){
        return view('web.report');
    }
    



















    
    // end
}
