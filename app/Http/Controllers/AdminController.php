<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\Image;
use App\Models\Newsletter;
use App\Models\ContactUs;

use Session;
use Cookie;

class AdminController extends Controller
{
    public function index()
    {
        $total_members = User::all(); //get total members

        $basic = User::where('membership_level', 'basic')->get(); //ge all basic members

        $premium = User::where('membership_level', 'premium')->get(); //ge all premium members

        $unapproved = User::where('is_approved', '0')->get(); //ge all unapproved members

        $suspended = User::where('is_suspend', '1')->get(); //ge all suspened members

        $deactivated = User::where('is_deactivated', '1')->get(); //ge all deactivated members

        $report_count = DB::table('user_reports')->get(); //get all member reports

        $user_subscriptions = User::leftJoin('user_subscriptions', 'users.id', '=', 'user_subscriptions.user_id')->where('user_subscriptions.is_expired', 0)->orderBy('id', 'DESC')->limit(5)->get();

        $reports = DB::table('user_reports')->leftJoin('users', 'user_reports.reporter_id', 'users.id')->orderBy('id', 'DESC')->limit(5)->get();

        $contacts = ContactUs::orderBy('id', 'DESC')->limit(5)->get(); //get conatcts


        $members = User::orderBy('id', 'DESC')->limit(5)->get(); //get new members

        return view('admin.index', compact('members', 'contacts', 'reports', 'user_subscriptions', 'report_count', 'total_members', 'basic', 'premium', 'unapproved', 'suspended', 'deactivated'));
    }

    




    public function notification_index()
    {
        $notifications = DB::table('notifications')->where('notification_to', 'admin')->orderBy('not_id', 'DESC')->paginate(25);

        return view('admin.notification', compact('notifications'));
    }

    




    public function login_index()
    {
        if(Admin::is_loggedin())
        {
            return redirect('/admin');
        }
        return view('admin.login');
    }
    






    public function login_admin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ]);

        $user = Admin::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return back()->with('error', 'Wrong email or password, try again!');
        }

        if(Admin::login($request->email))
        {
            if(Session::has('admin_old_url'))
            {
                $admin_old_url = Session::get('admin_old_url');
                Session::forget('admin_old_url');
                return redirect($admin_old_url);
            }
            return redirect('/admin');
        }
        return back()->with('error', 'Network error, try again!');
    }
    






    public function logout_admin()
    {
        if(Admin::logout())
        {
            return redirect('/admin/login');
        }
        return back();
    }
    






    public function basic_index(Request $request)
    {
        $basic = User::where('membership_level', 'basic')->where('is_deactivated', 0)->where('is_approved', 1);
        if($request->search)
        {
            if(preg_match('/@/', $request->search))
            {
                $basic->where('email', 'LIKE', "%{$request->search}%");
            }else{
                $basic->where('user_name', 'LIKE', "%{$request->search}%");
            }
        }

        $basics = $basic->paginate(25);
        
        
        return view('admin.basic', compact('basics'));
    }
    





    public function premium_index(Request $request)
    {
        $premium = User::where('membership_level', 'premium')->where('is_approved', 1)->where('is_deactivated', 0);
        
        if($request->search)
        {
            if(preg_match('/@/', $request->search))
            {
                $premium->where('email', 'LIKE', "%{$request->search}%");
            }else{
                $premium->where('user_name', 'LIKE', "%{$request->search}%");
            }
        }

        $premiums = $premium->paginate(25);

        return view('admin.premium', compact('premiums'));
    }




    public function deactivated_index(Request $request)
    {
        $deactivate = User::where('is_deactivated', 1);
        if($request->search)
        {
            if(preg_match('/@/', $request->search))
            {
                $deactivate->where('email', 'LIKE', "%{$request->search}%");
            }else{
                $deactivate->where('user_name', 'LIKE', "%{$request->search}%");
            }
        }

        $deactivates = $deactivate->paginate(25);

        return view('admin.deactivated', compact('deactivates'));
    }
    















    public function unapproved_index(Request $request)
    {
        $unapprove = User::where('is_approved', 0);
        if($request->search)
        {
            if(preg_match('/@/', $request->search))
            {
                $unapprove->where('email', 'LIKE', "%{$request->search}%");
            }else{
                $unapprove->where('user_name', 'LIKE', "%{$request->search}%");
            }
        }

        $unapproved = $unapprove->paginate(25);

        return view('admin.unapproved', compact('unapproved'));
    }










    public function update_notification($id)
    {
        $notification = DB::table('notifications')->where('notification_from', $id)->where('type', 'register')->where('notification_to', 'admin')->where('is_seen', 0)->first();
        if($notification)
        {
            DB::table('notifications')->where('notification_from', $id)->where('type', 'register')->where('notification_to', 'admin')->where('is_seen', 0)->update([
                'is_seen' => 1
            ]);
        }
    }
    




    public function member_detail_index($id)
    {
        $user = User::where('id', $id)->first();
        if(!$user)
        {
            return redirect('admin/404');
        }

       $this->update_notification($id);

        $gender = $user->gender == 'male' ? 'man' : 'woman';
        $display_name = $user->display_name ? $user->display_name : $user->user_name;

        $states = DB::table('states')->where('is_featured', 1)->get(); // aget all states
        
        $genotypes = DB::table('genotypes')->where('is_featured', 1)->get(); //get all genotypes options

        $ethnicities = DB::table('ethnicities')->where('is_featured', 1)->get(); //get all ethnicities options
   
        $heights = DB::table('height')->where('is_featured', 1)->get(); //get all height options

        $body_types = DB::table('body_type')->where('is_featured', 1)->get(); //get all body type options

        $weights = DB::table('weight')->where('is_featured', 1)->get(); //get all weight options

        $smokings = DB::table('smoking')->where('is_featured', 1)->get(); //get all smoking options

        $drinkings = DB::table('drinking')->where('is_featured', 1)->get(); //get all drinking options

        $marital_status = DB::table('marital_status')->where('is_featured', 1)->get(); //get all marital_status options


        return view('admin.member-detail', compact('user', 'display_name', 'gender', 'states', 'marital_status', 'smokings', 'drinkings', 'heights', 'weights', 'body_types', 'ethnicities', 'genotypes'));
    }
    




    public function error_index()
    {
        return view('admin.404');
    }
    




    public function add_member_index()
    {
        return view('admin.add-members');
    }
    



    public function add_member_store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|min:3|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'gender' => 'required'
        ]);

        $add = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'membership_level' => 'basic',
            ]);

        if($add)
        {
            return back()->with('success', 'Account created successfully');
        }
        return back()->with('error', 'Network error, try again!');
    }
    








    public function genotype_index()
    {
        $genotypes = DB::table('genotypes')->paginate(25);

        return view('admin.genotype', compact('genotypes'));
    }
    





    public function states_index()
    {
        $states = DB::table('states')->paginate(25);

        return view('admin.states', compact('states'));
    }
    








    public function marital_status_index()
    {
        $marital_status = DB::table('marital_status')->paginate(25);

        return view('admin.marital-status', compact('marital_status'));
    }
    



    public function drinking_index()
    {
        $drinking = DB::table('drinking')->paginate(25);

        return view('admin.drinking', compact('drinking'));
    }
    
    

    public function smoking_index()
    {
        $smoking = DB::table('smoking')->paginate(25);

        return view('admin.smoking', compact('smoking'));
    }
    



    public function body_type_index()
    {
        $body_types = DB::table('body_type')->paginate(25);

        return view('admin.body-types', compact('body_types'));
    }
    




    public function height_index()
    {
        $heights = DB::table('height')->paginate(25);

        return view('admin.heights', compact('heights'));
    }
    





    public function weights_index()
    {
        $weights = DB::table('weight')->paginate(25);

        return view('admin.weight', compact('weights'));
    }
    





    public function subscription_index()
    {
        $subscriptions = DB::table('subscriptions')->get();

        return view('admin.subscription', compact('subscriptions'));
    }
    




    public function edit_subscription_index($id)
    {
        $durations = DB::table('durations')->get();
        $subscription = DB::table('subscriptions')->where('sub_id', $id)->first();

        return view('admin.edit-subcription', compact('subscription', 'durations'));
    }


    

    public function edit_subscription_update(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required',
            'featured' => 'required',
            'description' => 'required|min:10|max:100'
        ]);

        $subscription = DB::table('subscriptions')->where('sub_id', $id)->first();
        if($subscription)
        {
            $amount = $request->amount ? $request->amount : 0;
            DB::table('subscriptions')->where('sub_id', $id)->update([
                        'amount' => $amount,
                        'duration' => $request->duration,
                        'sub_is_featured' => $request->featured,
                        'description' => $request->description,
            ]);
            return back()->with('success', 'Subscritpion updated successfully!');
        }
        return back()->with('error', 'Network error, try again later!');
    }
    
    





    public function user_subscription_index(Request $request)
    {
        $user_sub = User::leftJoin('user_subscriptions', 'users.id', '=', 'user_subscriptions.user_id')->where('user_subscriptions.is_expired', 0);

        if($request->search)
        {
            if(preg_match('/@/', $request->search))
            {
                $user_sub->where('email', 'LIKE', "%{$request->search}%");
            }else{
                $user_sub->where('user_name', 'LIKE', "%{$request->search}%");
            }
        }

        $user_subs = $user_sub->paginate(25);

        return view('admin.user-subscription', compact('user_subs'));
    }
    






    public function subscription_history_index($user_id)
    {
        $user_subs = DB::table('user_subscriptions')->leftJoin('users', 'user_subscriptions.user_id', 'users.id')->where('user_subscriptions.user_id', $user_id)->orderBy('start_date', 'DESC')->paginate(25);

        return view('admin.subscription-history', compact('user_subs'));
    }
    




    public function manual_subscription_index()
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

        return view('admin.manual-subscription', compact('images', 'descriptions', 'personalized'));
    }
    





    public function manual_subscription_store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:500'
        ]);

        $manuals = DB::table('settings')->where('id', 1)->first();
        $manual_subscription = json_decode($manuals->manual_subscription, true);

        if($manuals && $manuals->manual_subscription)
        {
            array_push($manual_subscription['descriptions'], $request->description);
           
            $store_items = json_encode($manual_subscription);
            DB::table('settings')->where('id', 1)->update([
                'manual_subscription' => $store_items
            ]);

            return back()->with('success', 'Description added successfull!');
        }
        return back()->with('error', 'Network error, try again later!');
    }





    




    
    public function contact_index()
    {
        $contacts = DB::table('contact_us')->paginate();

        return view('admin.contact', compact('contacts'));
    }






    public function contact_detail_index($id)
    {
        $contact = ContactUs::where('id', $id)->first();
        if($contact && !$contact->is_seen)
        {
            $contact->is_seen = 1;
            $contact->save();
        }

        $other_messages = ContactUs::where('email', $contact->email)->get();

        return view('admin.contact-detail', compact('contact', 'other_messages'));
    }
    
    



    public function report_index()
    {
        $users = DB::table('user_reports')->leftJoin('users', 'user_reports.reporter_id', '=', 'users.id')->paginate(25);

        return view('admin.reports', compact('users'));
    }
    




    public function report_detail_index($id)
    {
        $reporter = DB::table('user_reports')->leftJoin('users', 'user_reports.reporter_id', '=', 'users.id')->where('user_reports.report_id', $id)->first();
        $reported = User::where('id', $reporter->reported_id)->first();
        $other_reports = DB::table('user_reports')->leftJoin('users', 'user_reports.reporter_id', '=', 'users.id')->where('user_reports.reported_id', $reporter->reported_id)->get();

        if($reporter && !$reporter->is_seen)
        {
            DB::table('user_reports')->where('report_id', $id)->update([
                'is_seen' => 1
            ]);
        }

        return view('admin.report-detail', compact('reporter', 'reported', 'other_reports'));
    }








    public function profile_index()
    {
        $states = DB::table('states')->where('is_featured', 1)->get();

        $admin = Admin::where('email', Admin::admin('email'))->first();

        return view('admin.account', compact('states', 'admin'));
    }



    
    public function profile_update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'city' => 'required|max:50',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'gender' => 'required'
        ]);


        $check = Admin::where('email', $request->email)->where('id', Admin::admin('id'))->first();
        if(!$check)
        {
            $second_check = Admin::where('email', $request->email)->get();
            if(count($second_check))
            {
                return back()->with('error', '*The email '.$request->email.' already exists!');
            }
        }

        $admin = Admin::where('id', Admin::admin('id'))->first();
        if($admin)
        {
            $admin->first_name = strtolower($request->first_name);
            $admin->last_name = strtolower($request->last_name);
            $admin->email = $request->email;
            $admin->city = strtolower($request->city);
            $admin->state = strtolower($request->state);
            $admin->country = strtolower($request->country);
            $admin->gender = $request->gender;
            $admin->about = $request->about;
            if($admin->save())
            {
                return back()->with('success', 'Account updated successfully!');
            }
        }
        return back()->with('error', 'Network error, try again later!');
    }
    







    public function change_password_index()
    {
        return view('admin.change-password');
    }
    




    public function change_password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6|max:12',
            'new_password' => 'required|min:6|max:12|same:confirm_password',
            'confirm_password' => 'required|min:3|max:100',
        ]);
    
        $admin = Admin::where('id', Admin::admin('id'))->where('email', Admin::admin('email'))->first();
        if(!$admin || !Hash::check($request->old_password, $admin->password))
        {
            return back()->with('error', 'Wrong old password, try again!');
        }
    
        if($admin)
        {
            $admin->password = hash::make($request->new_password);
            $admin->save();
            return back()->with('success', 'Password updated successfully');
        }
    
    
    
        return back()->with('error', 'Network error, try again later');
    }
    







    public function privacy_policy_index()
    {
        $privacy = DB::table('settings')->where('id', 1)->first();

        return view('admin.privacy-policy', compact('privacy'));
    }




    public function privacy_policy_update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'privacy_policy' => 'required|min:50',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'privacy_title' => $request->title,
                'privacy_policy' => $request->privacy_policy,
            ]);
            return back()->with('success', 'Privacy policy updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }
    





    public function terms_index()
    {
        $terms = DB::table('settings')->where('id', 1)->first();

        return view('admin.terms', compact('terms'));
    }

    



    public function terms_update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'terms' => 'required|min:50',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'terms_title' => $request->title,
                'terms' => $request->terms,
            ]);
            return back()->with('success', 'Terms & Condition updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }

    





    public function about_us_index()
    {
        $about_us = DB::table('settings')->where('id', 1)->first();

        return view('admin.about', compact('about_us'));
    }


    


    public function about_us_update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'about_us' => 'required|min:50',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'about_us_title' => $request->title,
                'about_us' => $request->about_us,
            ]);
            return back()->with('success', 'About us updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }
    



    // $home_page = ["title" => "About Lagos Match Maker", "body" => " You Are Just Three Steps Away From A Greate Date You Are Just Three Steps Away From A Greate Date", "image" => "web/images/banner/5.jpg"];

    // print_r(json_encode($home_page)); 
    // die();

    public function settings_index()
    {
        $settings = DB::table('settings')->where('id', 1)->first();
        
        $home_page = $settings->home_page ? json_decode($settings->home_page, true) : array();


        $footer_left = $settings->footer_left ? json_decode($settings->footer_left, true) : array();

        $footer_middle = $settings->footer_middle ? json_decode($settings->footer_middle, true) : array();

  
// $home_pag = ["app_name" => "Lagosmatchmaker", "logo" => "web/images/icons/logo.png", "copy_right" => "Copyright lagosmatchmaker © 2021. All Rights Reserved."];

//     print_r(json_encode($home_pag)); 
//     die();



        return view('admin.settings', compact('settings', 'home_page', 'footer_left', 'footer_middle'));
    }
    



    public function home_page_update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'link' => 'required',
            'body' => 'required|min:10|max:100',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings->home_page)
        {
            $home_page = json_decode($settings->home_page, true);
        }

        $home_page['title'] = $request->title;
        $home_page['body'] = $request->body;
        $home_page['link'] = $request->link;

        if($settings)
        { 
            DB::table('settings')->where('id', 1)->update([
                'home_page' => json_encode($home_page)
            ]);
            return back()->with('success', 'Title updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }
    





    
    public function footer_left_update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'body' => 'required|min:10|max:100',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings->footer_left)
        {
            $footer_left = json_decode($settings->footer_left, true);
        }

        $footer_left['title'] = $request->title;
        $footer_left['body'] = $request->body;
        $old_image =  $footer_left['image'];

        if(Image::exists('image'))
        {
            $file = Image::files('image');
            $image = new Image();

            $fileName = Image::name('image', 'footer_image');
            $footer_left['image'] = 'web/images/banner/'.$fileName;
            $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 1000000,'file_destination' => 'web/images/banner/' ]);
            if(!$image->passed())
            {
                return back()->with('error', $image->error());
            }
            if($old_image)
            {
                Image::remove($old_image);
            }
        }else{
            $footer_left['image'] = $footer_left['image']; 
        }

        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'footer_left' => json_encode($footer_left)
            ]);
            return back()->with('success', 'Footer updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }









    public function tooter_middle_update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'body' => 'required|min:10|max:100',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings->home_page)
        {
            $footer_middle = json_decode($settings->home_page, true);
        }

        $footer_middle['title'] = $request->title;
        $footer_middle['body'] = $request->body;
        
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'footer_middle' => json_encode($footer_middle)
            ]);
            return back()->with('success', 'Footer updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }
     





    public function app_contact_update(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:11|max:11',
            'email' => 'required',
            'address' => 'max:255',
        ]);

        if(!is_numeric($request->phone))
        {
            return back()->with('error', 'Invalid phone number, try again!');
        }

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);
            return back()->with('success', 'Contact updated successfully!');
        }
        return back()->with('error', 'Network error, try again later');
    }
    







    public function side_detail_update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|min:3|max:50',
            'copy_right' => 'required|min:10|max:100',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();

        if(Image::exists('logo'))
        {
            $file = Image::files('logo');
            $image = new Image();

            $fileName = Image::name('logo', 'app_logo');
            $app_logo = 'web/images/icons/'.$fileName;
            $image->upload_image($file, [ 'name' => $fileName, 'size_allowed' => 1000000,'file_destination' => 'web/images/icons/' ]);
            if(!$image->passed())
            {
                return back()->with('error', $image->error());
            }
            if($settings->logo)
            {
                Image::remove($settings->logo);
            }
        }else{
            $app_logo = $settings->logo;
        }

        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'app_name' => $request->site_name,
                'copyright' => $request->copy_right,
                'logo' => $app_logo
            ]);
            return back()->with('success', 'Site detail updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }







    public function email_settings_index()
    {
        $email_settings = DB::table('settings')->where('id', 1)->first();

        return view('admin.email-settings', compact('email_settings'));
    }

    

    


    public function email_settings_update(Request $request)
    {
        $request->validate([
            'from_name' => 'required|max:50',
            'from_email' => 'required',
            'smtp_host' => 'required|max:50',
            'smtp_password' => 'required|max:100',
            'smtp_port' => 'required|max:50',
            'smtp_host' => 'required|max:50',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'from_name' => $request->from_name,
                'from_email' => $request->from_email,
                'smtp_host' => $request->smtp_host,
                'smtp_password' => $request->smtp_password,
                'smtp_port' => $request->smtp_port,
                'smtp_host' => $request->smtp_host,
            ]);
            return back()->with('success', 'Email settings updated successfully!');
        }
        return back()->with('error', 'Network error, try again later');
    }
    







    public function payment_settings_index()
    {
        $paystack = DB::table('settings')->where('id', 1)->first();

        return view('admin.payment-settings', compact('paystack'));
    }







    public function payment_settings_update(Request $request)
    {
        $request->validate([
            'test_key' => 'required|max:255',
            'live_key' => 'required|max:255',
            'is_paystack_activate' => 'required',
        ]);
        
        $is_paystack_activate = $request->is_paystack_activate ? '1' : '0';

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'paystack_test_key' => $request->test_key,
                'paystack_live_key' => $request->live_key,
                'is_paystack_activate' => $is_paystack_activate,
            ]);
            return back()->with('success', 'Payment settings updated successfully!');
        }
        return back()->with('error', 'Network error, try again later');
    }







    public function friends_index($id)
    {
        $friends = DB::table('likes')->where('initiator_id', $id)->orWhere('acceptor_id', $id)->where('is_accept', 1)->paginate(25);
    
        return view('admin.friends', compact('friends', 'id'));
    }

    
    



    public function read_chats_index(Request $request)
    {
        $chats = [];
        $chat_token = null;
        $chat_token1 = 'chat_'.$request->user.'_'.$request->friend;
        $chat_token2 = 'chat_'.$request->friend.'_'.$request->user;

        $user = User::where('id', $request->user)->first();
        $friend = User::where('id', $request->friend)->first();
        if(!$friend)
        {
            return redirect('/admin/friends/'.$request->user)->with('error', 'Friend does not exist');
        }

        $check = Chat::where('chat_token', $chat_token1)->orWhere('chat_token', $chat_token2)->first();
        if($check)
        {
            $chat_token = $check->chat_token;
            $count = count(Chat::where('chat_token', $check->chat_token)->get());
            $chat = Chat::where('chat_token', $check->chat_token);
            if($count > 0 && $count < 25)
            {
                $chats = $chat->limit($count)->get();
            }else{
                $take = 25;
                $skip = $count - $take;
                $chats = $chat->skip($skip)->take($take)->get();
            }
        }
       

        return view('admin.read-chats', compact('chats', 'user', 'friend', 'chat_token'));
    }








    
    



    public function banner_settings_index()
    {
        $sliders = DB::table('banners')->get(); //get all banners

        return view('admin.banner-settings', compact('sliders'));
    }
    




    public function incomplete_profile_alert_update(Request $request)
    {
        $request->validate([
            'profile_alert' => 'required|max:500',
        ]);

        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            DB::table('settings')->where('id', 1)->update([
                'profile_alert' => $request->profile_alert,
            ]);
            return back()->with('success', 'Profile alert updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }
    





    


    public function personalized_matching_update(Request $request)
    {
        $request->validate([
            'title' => 'max:30',
            'head' => 'max:30',
            'descriptions' => 'max:150'
        ]);


        $is_featured = $request->feature_personalized == 'true' ? 1 : 0;
        $settings = DB::table('settings')->where('id', 1)->first();
        if($settings)
        {
            $stored['title'] = $request->title; 
            $stored['head'] = $request->head; 
            $stored['descriptions'] = $request->descriptions; 
            $stored['is_feature']   = $is_featured;

            $personalized = json_encode($stored);

            DB::table('settings')->where('id', 1)->update([
                'personalized_match' => $personalized
            ]);
            return back()->with('success', 'Personalized match updated successfully!');
        }


        return back()->with('error', 'Network error, try again later');
    }



    




    public function news_letter_subscriptions_index()
    {
        $newsletters = DB::table('newsletter_subscriptions')->paginate(25);
        
        return view('admin.newsletter-subscriptions', compact('newsletters'));
    }
    







    public function compose_newsletter()
    {
        return view('admin.compose-newsletter');
    }
    





    public function compose_newsletter_store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'newsletter' => 'required|max:10000',
        ]);

        $newsletter = Newsletter::create([
                'title' => $request->title,
                'newsletter' => $request->newsletter,
        ]);
        
        if($newsletter)
        {
            return redirect('admin/news-letter')->with('success', 'Newsletter added successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }
    






    public function news_letter_index()
    {
        $subscribers = 0;
        $newsletters = Newsletter::where('is_save', 0)->where('is_sent', 0)->paginate(25);
        if(Session::has('newsletter'))
        {
            $subscribers = Session::get('newsletter');
            $subscribers = count($subscribers);
        }
        return view('admin.news-letter', compact('newsletters', 'subscribers'));
    }

    





    public function edit_newsletter_index($id)
    {
        $newsletter = Newsletter::where('id', $id)->first();

        return view('admin.edit-newsletter', compact('newsletter'));
    }






    public function edit_newsletter_update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'newsletter' => 'required|max:10000',
        ]);
        $newsletter = Newsletter::where('id', $id)->first();
        $newsletter->title = $request->title;
        $newsletter->newsletter = $request->newsletter;
        if($newsletter->save())
        {
            return back()->with('success', 'Newsletter updated successfully!');
        }

        return back()->with('error', 'Network error, try again later');
    }







    
    public function sent_letter_index()
    {
        $subscribers = 0;
        $newsletters = Newsletter::where('is_sent', 1)->paginate(25);
        if(Session::has('newsletter'))
        {
            $subscribers = Session::get('newsletter');
            $subscribers = count($subscribers);
        }
        
        return view('admin.sent-newsletters', compact('newsletters', 'subscribers'));
    }

    





    public function saved_letter_index()
    {
        $subscribers = 0;
        $newsletters = Newsletter::where('is_save', 1)->paginate(25);
        if(Session::has('newsletter'))
        {
            $subscribers = Session::get('newsletter');
            $subscribers = count($subscribers);
        }

        return view('admin.saved-newsletters', compact('newsletters', 'subscribers'));
    }
    





    public function newsletter_preview_index($id)
    {
        $newsletter = Newsletter::where('id', $id)->first();
        $app = DB::table('settings')->where('id', 1)->first();

        return view('admin.newsletter.newsletter-preview', compact('newsletter', 'app'));
    }
    






    public function how_it_works_index()
    {
        $how_it_works = DB::table('how_it_works')->get(); //get all how it works

        return view('admin.how-it-works', compact('how_it_works'));   
    }
















    // end
}
