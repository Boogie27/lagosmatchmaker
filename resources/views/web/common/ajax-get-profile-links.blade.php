
@php($user_detail = user_detail())
@php($is_loggedin = is_loggedin())






<li class="profile-status">
    Status: <span class="{{ $user->is_active ? 'active' : ''}}">{{ $user->is_active ? 'Online' : 'Offline'}}</span>
</li>
@if($is_loggedin && user('id') == $user->id)
<li class="profile-settings">
    <a href="{{ url('/friends') }}"><i class="fa fa-users"></i> Matches</a>
</li>
<li class="profile-settings">
    <a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a>
</li>
@endif
@if(!$is_loggedin)
    <li><a href="#" class="login_confirm_modal_popup"><i class="far fa-comment"></i> Message</a></li>
    <!-- <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-video"></i></a></li> -->
    <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Match</a></li>
@endif
    
@if($is_loggedin && $user_detail->id != $user->id)
    <li class="li-is-block-content" id="cant_message_member_btn">
        @if(!is_blocked($user_detail->id, $user->id))
            @if(is_matched($user->id))
            <a href="{{ url('/chat/'.$user->id) }}"><i class="far fa-comment"></i> Message</a>
            @endif
        @else
            @if(is_matched($user->id))
            <a href="#" class="cant-message-btn text-danger"><i class="far fa-comment"></i> Message</a>
            @endif
        @endif
    </li>
    
    <li id="li_unlike_member_btn">
        @if(is_matched($user->id))
        <a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Unmatch</a>
        @endif
    </li>
    
    <li class="li-is-block-content" id="li_like_member_btn">
        @if(!is_blocked($user_detail->id, $user->id))
            @if(!$was_liked && !$you_liked)
            <a href="#" class="user_like_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Match</a>
            @endif
        @endif
    </li>
@endif