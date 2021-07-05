<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Session;

use App\Classes\AgoraDynamicKey\RtcTokenBuilder;
use App\Events\MakeAgoraCall;

class AgoraVideoController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::is_loggedin())
        {
            return redirect('/');
        }
      
        $users = [];
        $likes = DB::table('likes')->where('initiator_id', Auth::user('id'))->where('is_accept', 1)->orWhere('acceptor_id', Auth::user('id'))->where('is_accept', 1)->get();        
        
       
        foreach($likes as $user)
        {
            if($user->initiator_id != Auth::user('id'))
            {
                $users[] = User::where('id', $user->initiator_id)->first();
            }
            if($user->acceptor_id != Auth::user('id'))
            {
                $users[] = User::where('id', $user->acceptor_id)->first();
            }
        }

        return view('web.agora-chat', compact('users'));
    }

    public function token(Request $request)
    {

        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');
        $channelName = $request->channelName;
        $user = Auth::user('user_name');
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

        return $token;
    }

    public function callUser(Request $request)
    {

        $data['userToCall'] = $request->user_to_call;
        $data['channelName'] = $request->channel_name;
        $data['from'] = Auth::user('id');

        broadcast(new MakeAgoraCall($data))->toOthers();
    }
}