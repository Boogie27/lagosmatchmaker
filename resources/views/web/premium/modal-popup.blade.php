





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
<section id="profile_match_section">
    <div class="profile-match-main">
        <div class="profile-match-dark-theme">
            <div class="profile-match-container">
                <img src="{{ asset('web/images/banner/match.png') }}" alt="" class="match-banner-img">
                <div class="title-header text-center"><!-- match heard start-->
                    <h4>You're Matched</h4>
                    <p>You and emeka have both liked each other</p>
                    <ul class="ul-profile-match">
                        <li class="profile-one">
                            <ul class="profile-one-content">
                                <li><h4>Jessica James</h4></li>
                                <li><p>Age: 25</p></li>
                                <li><p><i class="fa fa-map-marker-alt"></i> Lagos</p></li>
                            </ul>
                            <img src="{{ asset('web/images/avatar/15.jpg') }}" alt="">
                        </li>
                        <li><i class="fa fa-heart"></i></li>
                        <li class="profile-one">
                            <img src="{{ asset('web/images/avatar/28.png') }}" alt="">
                            <ul class="profile-two-content">
                                <li><h4>Emeka Ezeugo</h4></li>
                                <li><p>Age: 30</p></li>
                                <li><p><i class="fa fa-map-marker-alt"></i> Lagos</p></li>
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










<!-- SUBSCRIPTION ALERT START -->
<section class="modal-alert-popup" id="membership_sub_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Subscribe to premium to be able to call <br><b>Charles</b></p>
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
