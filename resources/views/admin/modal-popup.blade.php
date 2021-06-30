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
                        <div class="logout-btn"><a href="{{ url('/admin/ajax-logout') }}" id="logout_admin_user_submit" class="logout-btn text-danger">Logout</a></div> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- LOGOUT ALERT END-->










<!--  DEACTIVATEE USER ALERT START -->
<section class="modal-alert-popup" id="clear_notification_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to clear all notifications</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="submit"  data-url="{{ url('/admin/ajax-clear-all-notifications') }}" id="clear_notification_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DEACTIVATEE USER ALERT END -->











<!--  DEACTIVATEE USER ALERT START -->
<section class="modal-alert-popup" id="add_subscription_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p><b>Add User Subscription</b></p>
                    <div class="alert-form alert_sub_inputs text-danger"></div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group text-left">
                        <label for="">Type<span class="text-danger">*</span></label>
                        <select id="add_user_type_input"  class="selectpicker form-control">
                            <option value="">Subscription Type</option>
                            <option value="basic">Basic</option>
                            <option value="premium">Premium</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group text-left">
                        <label for="">Amount<span class="text-danger">*</span></label>
                        <input type="number" min="0" id="add_suser_sub_amount" class="form-control" placeholder="Amount">
                    </div>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  data-url="{{ url('/admin/ajax-add-user-subscription') }}" id="add_user_subscription_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DEACTIVATEE USER ALERT END -->
















<!--  NEWSLETTER MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_newesletters_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete these newsletters?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_newsletters_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  NEWSLETTER MODAL ALERT END -->











<!--  SEND MODAL ALERT START -->
<section class="modal-alert-popup" id="send_newesletter_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to send this newsletter?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" data-url="{{ url('/admin/ajax-send-newsletter') }}" id="send_newsletter_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  SEND MODAL ALERT END -->























































































