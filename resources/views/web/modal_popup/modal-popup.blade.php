




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





