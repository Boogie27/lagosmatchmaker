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




<!-- GENERAL CONFIRM ALERT START -->
<section class="modal-alert-popup" id="confirm_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this items <br><b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="submit"  class="login-confirm-submit-btn confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- GENERAL CONFIRM ALERT END -->











<!--  SUSPEND USER ALERT START -->
<section class="modal-alert-popup" id="confirm_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to suspend <br><b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="member_suspend_id_input">
                        <button type="submit"  data-url="{{ url('/ajax-suspend-member') }}" id="suspend_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  SUSPEND USER ALERT END -->







<!--  APPROVE USER ALERT START -->
<section class="modal-alert-popup" id="approve_user_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to suspend <b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="member_approve_id_input">
                        <button type="submit"  data-url="{{ url('/ajax-approve-member') }}" id="approve_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  APPROVE USER ALERT END -->








<!--  DEACTIVATEE USER ALERT START -->
<section class="modal-alert-popup" id="deactivate_user_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to suspend <b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="deactivate_approve_id_input">
                        <button type="submit"  data-url="{{ url('/ajax-deactivate-member') }}" id="deactivate_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DEACTIVATEE USER ALERT END -->

































































































































