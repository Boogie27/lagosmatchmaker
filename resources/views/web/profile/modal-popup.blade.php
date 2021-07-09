





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
                    <form action="{{ url('/manual-payment') }}" method="GET">
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



