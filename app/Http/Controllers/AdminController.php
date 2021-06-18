<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Admin;
use App\Models\Image;
use App\Models\ContactUs;

use Session;
use Cookie;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::where('in_control', 1)->first();
        return view('admin.index', compact('admin'));
    }





    public function login_index()
    {
        $admin = Admin::where('in_control', 1)->first();
        return view('admin.login', compact('admin'));
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
            if(Session::has('old_url'))
            {
                $old_url = Session::get('old_url');
                Session::forget('old_url');
                return redirect($old_url);
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
    






    public function basic_index()
    {
        $basics = User::where('membership_level', 'basic')->where('is_deactivated', 0)->where('is_approved', 1)->paginate(25);
        
        return view('admin.basic', compact('basics'));
    }
    





    public function premium_index()
    {
        $premiums = User::where('membership_level', 'premium')->where('is_approved', 1)->where('is_deactivated', 0)->paginate(25);
        
        return view('admin.premium', compact('premiums'));
    }




    public function deactivated_index()
    {
        $deactivates = User::where('is_deactivated', 1)->paginate(25);
        
        return view('admin.deactivated', compact('deactivates'));
    }
    




    public function unapproved_index()
    {
        $unapproved = User::where('is_approved', 0)->where('is_deactivated', 0)->paginate(25);
        
        return view('admin.unapproved', compact('unapproved'));
    }


    




    public function member_detail_index($id)
    {
        $user = User::where('id', $id)->first();
        if(!$user)
        {
            return redirect('admin/404');
        }
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
            DB::table('subscriptions')->where('sub_id', $id)->update([
                        'amount' => $request->amount,
                        'duration' => $request->duration,
                        'sub_is_featured' => $request->featured,
                        'description' => $request->description,
            ]);
            return back()->with('success', 'Subscritpion updated successfully!');
        }
        return back()->with('error', 'Network error, try again later!');
    }
    
    





    public function user_subscription_index()
    {
        $user_subs = User::leftJoin('user_subscriptions', 'users.id', '=', 'user_subscriptions.user_id')->where('user_subscriptions.is_expired', 0)->paginate(25);


        return view('admin.user-subscription', compact('user_subs'));
    }
    





    public function subscription_history_index($user_id)
    {
        $user_subs = DB::table('user_subscriptions')->leftJoin('users', 'user_subscriptions.user_id', 'users.id')->where('user_subscriptions.user_id', $user_id)->paginate(25);

        return view('admin.subscription-history', compact('user_subs'));
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
    





    
    public function tooter_left_update(Request $request)
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


    




// web/images/icons/logo.png







































    // end
}
