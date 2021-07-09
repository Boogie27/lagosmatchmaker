


<!-- LOOKING FOR SECTION -->
 <div class="profile-detail-left">
    <div class="title-header">
        <h4>Looking for</h4>
        @if(is_loggedin() && user('id') == $user->id)
        <a href="#" id="looking_for_btn_open"><i class="fa fa-pen"></i></a>
        @endif
    </div>
    <ul class="ul-profile-detail" id="ul_looking_for_body">
        <li>
            @if($user->looking_for_detail)
            <p class="detail-about-p"> {{ $user->looking_for_detail }}</p>
            @else
            <p class="detail-about-p">Describe the type of a person you are looking for</p>
            @endif
        </li>
    </ul>
</div>













