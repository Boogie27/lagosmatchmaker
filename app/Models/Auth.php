<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use Session;
use Cookie;


class Auth extends Model
{
    use HasFactory;



    public static function user($string = null)
    {
        if(Session::has('user'))
        {
            if($string)
            {
                return Session::get('user')[$string];
            }
            return Session::get('user');
        }
        return false;
    }






    public static function login($email, $remember_me = null)
    {
        if($email)
        {
            $cookie_hash = null;
            $user = User::where('email', $email)->first();
            if($user)
            {
                $login_user['id'] = $user->id;
                $login_user['email'] = $user->email;
                $login_user['user_name'] = $user->user_name;
                $login_user['display_name'] = $user->display_name;
                $login_user['image'] = $user->image;   
                $login_user['avatar'] = $user->avatar; 
                $login_user['date_registered'] = $user->date_registered;  

                
                if($remember_me)
                {
                    $cookie_expiry = 604800;
                    $cookie_hash = uniqid();

                    if($user->remember_me)
                    {
                        $cookie_hash = $user->remember_me;
                        Cookie::forget('remember_me');
                    }
        
                    Cookie::make('remember_me', $cookie_hash, $cookie_expiry);
                }else if($user->remember_me){
                    $cookie_hash = $user->remember_me;
                }

                $user->is_active = 1;
                $user->remember_me = $cookie_hash;
                if($user->update())
                {
                    Session::put('user', $login_user);
                    return true;
                }
            }
        }
        return false;
    }










    public static function is_loggedin(){
        if(Session::has('user'))
        {
            $user = Session::get('user');
            $loggedIn = User::where('email', $user['email'])->where('id', $user['id'])->where('is_active', 1)->first();
            if($loggedIn)
            {
                return true;
            }
        }
        return false;
    }






    public static function logout()
    {
        if(Session::has('user'))
        {
            $detail = Session::get('user');
            $user = User::where('email', $detail['email'])->where('id', $detail['id'])->first();
            if($user)
            {
                if(Cookie::has('remember_me'))
                {
                    Cookie::forget('remember_me');
                }

                $user->is_active = 0;
                $user->last_login = date('Y-m-d H:i:s');
                $user->save();

                Session::forget('user');
                return true;
            }
        }
        return false;
    }








    public static function remember_login($remember_me)
    {
        if($remember_me){
            $connection = new DB();
            $user = $connection->select('course_users')->where('remember_me', $remember_me)->first();
            if($user)
            {
                if(self::login($user->email))
                {
                    return true;
                }
            }
        }
        return false;
    }
}
