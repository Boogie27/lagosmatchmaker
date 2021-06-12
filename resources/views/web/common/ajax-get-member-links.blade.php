@php($name = $user->display_name ? ucfirst($user->display_name) : ucfirst($user->user_name))

@if(user('id') != $user->id && !get_like($user->id))
<li><a href="{{ url('/ajax-like-user') }}" data-links="{{ url('/ajax-get-member-links') }}" data-url="{{ current_url() }}" data-name="{{ $name }}" class="like-a-member-btn" id="{{ $user->id }}"><i class="far fa-heart"></i></a></li>
@endif
@if(user('id') != $user->id && get_like($user->id) && get_like($user->id)->is_accept)
<li><a href="{{ url('/chat/'.$user->id) }}" data-name="{{ $name }}" id="{{ $user->id }}"><i class="far fa-envelope"></i></a></li>
<li><a href="#" data-name="{{ $name }}" class="unlike-a-member-btn" id="{{ $user->id }}"><i class="far fa-heart text-success"></i></a></li>
<li><a href="#" data-name="{{ $name }}" class="video_call_open_btn" id="{{ $user->id }}"><i class="fa fa-video"></i></a></li>
@endif
@if(user('id') != $user->id && get_like($user->id) && !get_like($user->id)->is_accept)
<li><a href="#" data-name="{{ $name }}" class="user-like-confrim-member-btn" id="{{ $user->id }}"><i class="far fa-heart text-danger"></i></a></li>
@endif