<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Admin;
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

        return view('admin.contact-detail', compact('contact'));
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

        return view('admin.report-detail', compact('reporter', 'reported', 'other_reports'));
    }

























    // end
}
