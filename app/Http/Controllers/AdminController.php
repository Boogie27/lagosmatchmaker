<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Admin;

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
        $basics = User::where('membership_level', 'basic')->paginate(25);
        
        return view('admin.basic', compact('basics'));
    }
    





    public function premium_index()
    {
        $premiums = User::where('membership_level', 'premium')->paginate(25);
        
        return view('admin.premium', compact('premiums'));
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
    



    // end
}
