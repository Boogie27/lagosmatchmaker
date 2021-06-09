





<!-- VIDEO CALL START-->
<section id="video_call_section">
    <div class="video-call-main">
        <div class="video-call-dark-theme">
            <div class="video-call-container">
                <ul class="ul-video-call">
                    <li>
                        <img src="{{ asset('web/images/avatar/15.jpg') }}" alt="">
                    </li>
                    <li>
                        <h4>James Jessica <span class="text-success">Video Calling...</span></h4>
                    </li>
                    <li>
                        <div class="call-btn bg-danger">
                            <a href="#" id="video_call_close_btn"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="call-btn bg-success">
                            <a href="#"><i class="fa fa-video"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
     </div>
</section>
<!-- VIDEO CALL END-->






<!-- ROFILE BOTTOM BAR START-->
<!-- <section id="profile-option-section">
    <div class="p-option-container">
        <ul class="ul-p-option-body">
            <li><a href="{{ url('/chat') }}"><i class="far fa-comment"></i></a></li>
            <li><a href="#"><i class="far fa-heart"></i></a></li>
            <li><a href="#"><i class="fa fa-video"></i></a></li>
            <li><a href="#"><i class="far fa-user"></i></a></li>
        </ul>
    </div>
</section> -->
<!-- ROFILE BOTTOM BAR END-->




<!-- MATCH START-->
@if(is_loggedin())
<section id="profile_match_section">
    <div class="profile-match-main">
        <div class="profile-match-dark-theme">
            <div class="profile-match-container">
                <img src="{{ asset('web/images/banner/match.png') }}" alt="" class="match-banner-img">
                <div class="title-header text-center" id="matched_detail_modal_popup"><!-- match heard start-->
                    <h4>You're Matched</h4>
                    <p>You and {{ $display_name }} have both liked each other</p>
                    <ul class="ul-profile-match">
                        <li class="profile-one">
                            @php($my_image =  avatar(user_detail()->display_image, user_detail()->gender))
                            @php($my_name = user_detail()->display_name ? user_detail()->display_name : user_detail()->user_name)
                            <ul class="profile-one-content">
                                <li><h4>{{ ucfirst($my_name) }}</h4></li>
                                <li><p>Age: {{ user_detail()->age ?? 'No age' }}</p></li>
                                <li><p><i class="fa fa-map-marker-alt"></i> {{ user_detail()->location ?? 'No location' }}</p></li>
                            </ul>
                            <img src="{{ asset($my_image) }}" alt="{{ $my_name }}">
                        </li>
                        <li class="match-heart-icon"><i class="fa fa-heart"></i></li>
                        <li class="profile-one">
                            <img src="{{ asset($profile_image) }}" alt="{{ $display_name }}">
                            <ul class="profile-two-content">
                                <li><h4>{{ ucfirst($display_name) }}</h4></li>
                                <li><p>Age: {{ $user->age ?? 'No age'}}</p></li>
                                <li><p><i class="fa fa-map-marker-alt"></i> {{ $user->location ?? 'No location' }}</p></li>
                            </ul>
                        </li>
                    </ul>
                </div> <!-- match heard end-->
                <div class="profile-match-body">
                    <ul>
                        <li><a href="#" class="match-anchor-btn">Send a message</a></li>
                        <li><a href="#" id="profile_match_close_btn">Back to Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
     </div>
</section>
<!-- MATCH END-->
@endif









<!-- SUBSCRIPTION ALERT START -->
<section class="modal-alert-popup" id="membership_sub_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Subscribe to premium to be able to call <br><b>{{ ucfirst($display_name) }}</b></p>
                </div>
                <div class="confirm-form">
                    <form action="{{ url('/subscription') }}" method="GET">
                        <button type="submit"  id="subscribe_to_plan_submit_btn" class="confirm-btn">Subscribe Now</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SUBSCRIPTION ALERT END -->













<!-- CONFIRM ALERT START -->
<section class="modal-alert-popup" id="login_confirm_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Signup or Login to chat with <br><b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="{{ url('/login') }}" method="GET">
                        <button type="submit" id="login_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONFIRM ALERT END -->









<!-- UNLIKE MODAL  START -->
<section class="modal-alert-popup" id="unlike_user_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to unlike <b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="GET">
                        <button type="submit" id="unlike_user_modal_submit_btn" class="confirm-btn">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- UNLIKE MODAL  END -->



