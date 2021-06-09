



<div class="avatar-img-preview" id="vatar_img_preview"><!-- avatar img preview start-->
    <img src="{{ asset($profile_image) }}" id="profile_avatar_preview_image" alt="{{ $user->user_name }}">
</div> <!-- avatar img preview end-->
<div class="avatar-body"><!-- avatar img  start-->
    <div class="avatar-img" id="profile_image_main">
        @if($user->profile_image)
        <a href="#" id="profile_image"><img src="{{ asset($user->profile_image) }}" alt="{{ $user->user_name }}"></a>
        @endif
    </div>
    @if(count($avatars))
        @foreach($avatars as $avatar)
        <div class="avatar-img">
            <a href="#" id="{{ $avatar->id }}"><img src="{{ asset($avatar->avatar) }}" alt=""></a>
        </div>
        @endforeach
    @endif
</div><!-- avatar img  end--><!-- avatar img  end-->