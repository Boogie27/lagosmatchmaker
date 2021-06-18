<?php



use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Chat;
use App\Models\Auth;
use App\Models\Admin;
use App\Models\ContactUs;







function money($string)
{
    // $money = "₦";
    return number_format($string);
}





// function image($image, $avatar, $gender, $toggle)
// {
//     if($image && $avatar)
//     {
//         return $toggle == 1 ? $image : $avatar;
//     }

//     if($image && !$avatar)
//     {
//         return $image;
//     }

//     if(!$image && $avatar)
//     {
//         return $avatar;
//     }

//     if($gender == 'male' && !$image && !$avatar)
//     {
//         return 'web/images/avartar/male.png';
//     }

//     if($gender == 'female' && !$image && !$avatar)
//     {
//         return 'web/images/avartar/female.jpg';
//     }

//     return false;
// }







function display_name($display_name, $user_name)
{
    return $display_name ? ucfirst($display_name) : ucfirst($user_name);
}





function current_url()
{
    return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}





function is_loggedin(){
    if(Session::has('user'))
    {
        $user = Session::get('user');
        $loggedIn = User::where('email', $user['email'])->where('id', $user['id'])->where('is_deactivated', 0)->where('is_active', 1)->first();
        if($loggedIn)
        {
            return true;
        }
    }
    return false;
}






function user_detail()
{
    if(Session::has('user'))
    {
        $user = Session::get('user');
        $loggedIn = User::where('email', $user['email'])->where('id', $user['id'])->where('is_deactivated', 0)->where('is_active', 1)->first();
        if($loggedIn)
        {
            return $loggedIn;
        }
    }
    return false;
}







function user($string){
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












function nav_user_likes()
{
    $count = 0;
    if(Auth::is_loggedin())
    {
        $like_count = DB::table('likes')->where('acceptor_id', Auth::user('id'))->where('is_accept', 0)->get();
        if(count($like_count))
        {
            $count = count($like_count);
        }
    }
    return $count;
}






function last_chat($user_id)
{
    if($user_id)
    {
        $chat_token_1 = 'chat_'.Auth::user('id').'_'.$user_id;
        $chat_token_2 = 'chat_'.$user_id.'_'.Auth::user('id');

        $chats = Chat::where('chat_token', $chat_token_1)->orWhere('chat_token', $chat_token_2)->first();
       
        if($chats)
        {
            $last_chat = Chat::where('chat_token', $chats->chat_token)->orderBy('chat_id', 'DESC')->first();
            return $last_chat;
        }
    }
    return false;
}







function unread($sender_id)
{
    if($sender_id)
    {
        $chats = Chat::where('sender_id', $sender_id)->where('receiver_id', Auth::user('id'))->where('is_seen', 0)->get();
        if(count($chats))
        {
            return count($chats);
        }
    }
    return false;
}






function chat_time($time)
{
    return  date('h:i', strtotime($time));
}








function unread_nav_msg()
{
    if(Session::has('user'))
    {
        $chats = Chat::where('receiver_id', Auth::user('id'))->where('is_seen', 0)->get();
        if(count($chats))
        {
            return count($chats);
        }
    }
    return false;
}







function get_like($user_id)
{
    if($user_id)
    {
        $is_friends = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('acceptor_id', $user_id)
                    ->orWhere(function($query) use ($user_id){
                        $query->where('initiator_id', $user_id)->where('acceptor_id', Auth::user('id'));
                    })->first();
        if($is_friends)
        {
            return $is_friends;
        }
    }
    return false;
}







// ***********************************************************************************************************************************************//
//                    ADMIN HELPER SECTION                                                                                                        //
// ***********************************************************************************************************************************************//


function admin_image($image, $gender)
{
    $img = 'admins/images/profile_image/female.jpg';
    if($gender == 'male')
    {
        $img = 'admins/images/profile_image/male.png';
    }
    if($image)
    {
       $img = $image;
    }
    return $img;
}





function admin_loggedin(){
    if(Admin::is_loggedin())
    {
        return true;
    }
    return false;
}







function admin($string = null){
    if(Session::has('admin'))
    {
        return Admin::admin($string);
    }
    return false;
}






function contact_count(){
    $count = 0;
    $contacts = ContactUs::where('is_seen', 0)->get();
    if(count($contacts))
    {
        return count($contacts);
    }
    return $count;
}











function report_count(){
    $count = 0;
    $reports = DB::table('user_reports')->where('is_seen', 0)->get();
    if(count($reports))
    {
        return count($reports);
    }
    return $count;
}







function user_report_count($reported_id){
    $count = 0;
    $reports = DB::table('user_reports')->where('reported_id', $reported_id)->get();
    if(count($reports))
    {
        return count($reports);
    }
    return $count;
}