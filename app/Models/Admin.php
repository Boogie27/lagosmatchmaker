<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Session;

class Admin extends Model
{
    use HasFactory;
    protected $guarded = [];






    public static function admin($string = null)
    {
        if(Session::has('admin'))
        {
            if($string)
            {
                return Session::get('admin')[$string];
            }
            return Session::get('admin');
        }
        return false;
    }






    public static function login($email)
    {
        if($email)
        {
            $cookie_hash = null;
            $admin = self::where('email', $email)->first();
            if($admin)
            {
                $admin_detail['id'] = $admin->id;
                $admin_detail['first_name'] = $admin->first_name;
                $admin_detail['last_name'] = $admin->last_name;
                $admin_detail['email'] = $admin->email;
                $admin_detail['image'] = $admin->image;   
                $admin_detail['gender'] = $admin->gender; 
                $admin_detail['city'] = $admin->city;  
                $admin_detail['state'] = $admin->state;  
                $admin_detail['country'] = $admin->country;  
                $admin_detail['is_active'] = $admin->is_active;  
                $admin_detail['type'] = $admin->type;  

                $admin->is_active = 1;
                if($admin->update())
                {
                    Session::put('admin', $admin_detail);
                    return true;
                }
            }
        }
        return false;
    }





    public static function is_loggedin(){
        if(Session::has('admin'))
        {
            $admin = Session::get('admin');
            $loggedIn = self::where('email', $admin['email'])->where('id', $admin['id'])->where('is_active', 1)->first();
            if($loggedIn)
            {
                return true;
            }
        }
        return false;
    }






    public static function logout()
    {
        if(Session::has('admin'))
        {
            $detail = Session::get('admin');
            $admin = self::where('email', $detail['email'])->where('id', $detail['id'])->first();
            if($admin)
            {
                $admin->is_active = 0;
                $admin->last_login = date('Y-m-d H:i:s');
                $admin->save();

                Session::forget('admin');
                return true;
            }
        }
        return false;
    }






    // end
}
