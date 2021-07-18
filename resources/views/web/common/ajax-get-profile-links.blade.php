<li class="profile-status">
    Status: <span class="{{ $user->is_active ? 'active' : ''}}">{{ $user->is_active ? 'Online' : 'Offline'}}</span>
</li>
@if(is_loggedin() && user('id') == $user->id)
<li class="profile-settings">
    <a href="{{ url('/friends') }}"><i class="fa fa-users"></i> Friends</a>
</li>
<li class="profile-settings">
    <a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a>
</li>
@endif
@if(!is_loggedin())
    <li><a href="#" class="login_confirm_modal_popup"><i class="far fa-comment"></i> Message</a></li>
    <!-- <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-video"></i></a></li> -->
    <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-heart"></i> Like</a></li>
@endif
    
@if(is_loggedin() && user_detail()->id != $user->id)
    @if($was_liked && $was_liked->is_accept || $you_liked && $you_liked->is_accept)
    <li><a href="{{ url('/chat/'.$user->id) }}"><i class="far fa-comment"></i> Message</a></li>
    @endif
    <!-- <li><a href="#" id="user_video_call_modal_popup"><i class="fa fa-video"></i></a></li> -->
    @if($was_liked && $was_liked->is_accept || $you_liked && $you_liked->is_accept)
    <li><a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart"></i> Unlike</a></li>
    @endif
    @if(!$was_liked && !$you_liked)
    <li><a href="#" class="user_like_confirm_modal_popup"><i class="fa fa-heart"></i> Like</a></li>
    @endif
@endif