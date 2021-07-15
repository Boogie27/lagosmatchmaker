<?php



use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Chat;
use App\Models\Auth;
use App\Models\Admin;
use App\Models\Newsletter;
use App\Models\ContactUs;







function money($string)
{
    // $money = "₦";
    return number_format($string);
}




function number_count($string)
{
    return number_format($string);
}









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








function is_complete()
{
    $state = false;
    if(Auth::user('id'))
    {
        $user = User::where('id', Auth::user('id'))->where('email', Auth::user('email'))->where('is_complete', 0)->first();
        if($user)
        {
            if($user->about && $user->age && $user->location && 
                $user->marital_status && $user->religion && $user->looking_for && 
                $user->smoking && $user->drinking && $user->interest 
                && $user->genotype && $user->language && $user->height && $user->weight 
                && $user->body_type && $user->ethnicity && $user->HIV && $user->complexion 
                && $user->education && $user->career && !$user->is_complete)
            {
                $state = true;
                $user->is_complete = 1;
                $user->save();
            }
        }
    }
    return $state;
}






function end_subscription_notification()
{
    if(Session::has('user'))
    {
        $notification = DB::table('notifications')->where('notification_from', 'admin')->where('notification_to', Auth::user('id'))
                                 ->where('type', 'expired_subscription')->where('is_seen', 0)->first();
        if($notification)
        {
            return $notification;
        }                      
        return false;
    }
}









function approved_notification()
{
    $notification = DB::table('notifications')->where('notification_from', 'admin')
                    ->where('notification_to', Auth::user('id'))->where('type', 'approved')->first();
    if($notification)
    {
        return $notification;
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








function simily_message_count($email){
    $count = 0;
    $messages = ContactUs::where('email', $email)->get();
    if(count($messages))
    {
        return count($messages);
    }
    return $count;
}








function title(){
    $back_url = $_SERVER['PHP_SELF'];
    $filename = explode('.', basename($back_url));
    
    $main_title = implode(' ', explode('-', $filename[0]));
    if($main_title == 'index')
    {
        $main_title = 'home';
    }
    return $main_title;
}





function settings(){
    $settings = DB::table('settings')->where('id', 1)->first();
    if($settings)
    {
        return $settings;
    }
    return false;
}







function get_friends($user_id, $friend){
    if($friend)
    {
        $id = $friend->initiator_id == $user_id ? $friend->acceptor_id : $friend->initiator_id;

        $user = User::where('id', $id)->first();
        if($user)
        {
            return $user;
        }
    }
    return false;
}









function admin_notification()
{
    $notifications = ['un_seen' => 0, 'nav_notification' => null, 'notification' => null];

    $un_seen = DB::table('notifications')->where('notification_to', 'admin')->where('is_seen', 0)->get();
    if(count($un_seen))
    {
        $notifications['un_seen'] = count($un_seen);
    }

    $nav_notification = DB::table('notifications')->where('notification_to', 'admin')->orderBy('date_sent', 'DESC')->limit(20)->get();
    if(count($nav_notification))
    {
        $notifications['nav_notification'] = $nav_notification;
    }

    $all_notification = DB::table('notifications')->where('notification_to', 'admin')->orderBy('date_sent', 'DESC')->paginate(30);
    if(count($all_notification))
    {
        $notifications['notification'] = $all_notification;
    }

    return $notifications;
}








function admin_notification_count()
{
    $notification = DB::table('notifications')->where('notification_to', 'admin')->where('is_seen', 0)->get();
    if(count($notification))
    {
        return count($notification);
    }
    return false;
}






function get_reported_member($user_id)
{
    if($user_id){
        $user = User::where('id', $user_id)->first();
        if($user)
        {
            return $user->user_name;
        }
    } 
    return false;
}






function news_subs($id)
{
    $state = false;
    if(Session::has('newsletter'))
    {
        $subs = Session::get('newsletter');
        foreach($subs as $sub)
        {
            if($id == $sub['id'])
            {
                $state = true;
            }
        }
    }
    return $state;
}












function checked_member($id)
{
    $state = false;
    if(Session::has('checked_members'))
    {
        $members = Session::get('checked_members');
        foreach($members as $member)
        {
            if($id == $member['id'])
            {
                $state = true;
            }
        }
    }
    return $state;
}









function detail_is_complete()
{
    $state = false;
    $users = User::where('is_complete', 1)->get();
    if(count($users))
    {
        $state = count($users);
    }
    return $state;
}






function newsletters()
{
    return Newsletter::all();
}

