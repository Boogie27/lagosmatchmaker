




<!-- LOGOUT ALERT START-->
<section id="logout_preloader_container">
    <div class="logout-preloader-container">
        <div class="logout-preloader-dark-theme">
            <div class="logout-inner-content">
                <ul class="ul-logout">
                    <li class="logout-first">
                        <h4>Logout?</h4>
                        <p>Are you sure you want to logout?</p>
                    </li>
                    <li class="logout-btns">
                        <div class="logout-cancle"><a href="#" id="logout_user_cancle_btn">Cancle</a> </div>
                        <div class="logout-btn"><a href="{{ url('/ajax-logout') }}" id="logout_user_btn" class="logout-btn text-danger">Logout</a></div> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- LOGOUT ALERT END-->









<!-- BOTTOM ALERT DANGER POPUP START-->
<section class="bottom-alert" id="bottom_alert_danger">
    <div class="bottom-alert-danger">Network error, try again later!</div>
</section>
<!--  BOTTOM ALERT DANGER POPUP START-->





<!-- BOTTOM ALERT SUCCESS POPUP START-->
<section class="bottom-alert" id="bottom_alert_success">
    <div class="bottom-alert-success">Network error, try again later</div>
</section>
<!--  BOTTOM ALERT SUCCESS POPUP START-->








<!-- CONFIRM ALERT START -->
<section class="modal-alert-popup" id="confirm_modal_popup">
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
                        <button type="submit"  class="login-confirm-submit-btn confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONFIRM ALERT END -->







<!-- SUBSCRIPTION ALERT START -->
<section class="modal-alert-popup" id="user_confirm_sub_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Subscribe to premium to be able to call <br><b>simbi</b></p>
                </div>
                <div class="confirm-form">
                    <form action="{{ url('/subscription') }}" method="GET">
                        <button type="submit"  id="@subscribe_to_plan_submit_btn" class="confirm-btn">Subscribe Now</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SUBSCRIPTION ALERT END -->







<!-- SUBSCRIPTION ALERT START -->
<section class="modal-alert-popup" id="user_confirm_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to unlike <b>simbi</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="GET">
                        <input type="hidden" data-url="{{ url('/ajax-unlike-matched-user') }}" id="user_unlike_id_input" value="">
                        <button type="button"  id="user_confirm_unlike_submit" class="confirm-btn">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SUBSCRIPTION ALERT END -->











<!-- MATCH START-->
<section class="member-match-form-container" id="profile_match_open_btn">
    <div class="profile-match-main">
        <div class="profile-match-dark-theme">
            <div class="profile-match-container">
                <img src="{{ asset('web/images/banner/match.png') }}" alt="" class="match-banner-img">
                <div class="center-body" id="add_match_members_profile">
                    <!-- <div class="title-header text-center">
                        <h4>You're Matched</h4>
                        <p>You and emeka have both liked each other</p>
                        <ul class="ul-profile-match">
                            <li class="profile-one">
                                <ul class="profile-one-content">
                                    <li><h4>Jessica James</h4></li>
                                    <li><p>Age: 25</p></li>
                                    <li><p><i class="fa fa-map-marker-alt"></i> Lagos</p></li>
                                </ul>
                                <div class="profile-head-img"><h4>F</h4></div>
                            </li>
                            <li><i class="fa fa-heart"></i></li>
                            <li class="profile-one">
                                <div class="profile-head-img"><h4>M</h4></div>
                                <ul class="profile-two-content">
                                    <li><h4>Emeka Ezeugo</h4></li>
                                    <li><p>Age: 30</p></li>
                                    <li><p><i class="fa fa-map-marker-alt"></i> Lagos</p></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="profile-match-body">
                        <ul>
                            <li><a href="#" class="match-anchor-btn">Send a message</a></li>
                            <li><a href="#" class="member_match_close_btn">Back to Profile</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
     </div>
</section>
<!-- MATCH END-->















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













 <!-- NOTIFICATION BANNER START -->
            <!-- <div class="top-banner-start" id="top_banner_alert">
                <div class="top-banner-inner success" id="top_banner_inner">
                    <i class="fa fa-times" id="top_banner_cancle_btn"></i>
                    <div class="containment">
                        <i class="fa fa-bell"></i>
                        <span>
                            complete your profile details to be approved 
                            by lagosmatchmaker
                        </span>
                    </div>
                </div>
            </div> -->
<!-- NOTIFICATION BANNER END -->