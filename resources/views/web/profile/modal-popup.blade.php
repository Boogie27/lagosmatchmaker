





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









<!--  PROFILE MODAL START -->
<section class="modal-alert-popup" id="cropper_modal_popup_box">
    <div class="sub-confirm-container" id="">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content cropper">
                <!-- <div class="text-right">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div> -->
                <div class="confirm-header">
                    <p><b>Crop image</b></p>
                </div>
                <div class="cropper-form" id="profile_image_cropper">
                    <div class="inner-cropper-img">
                        <img src="{{ asset('web/images/avatar/male.png') }}" alt="" id="cropper_sample_img">
                    </div>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <a href="#" class="gallery-btn confirm-box-close"><i class="fa fa-trash"></i></a>
                        <button type="button"  id="cropper_confirm_submit_btn" class="btn-empty">
                            <i class="fa fa-arrow-up"></i>
                            Upload image
                        </button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  PROFILE MODAL ALERT END -->







<!--  PROFILE MODAL START -->
<section class="modal-alert-popup" id="profile_img_option_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content cropper">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <h3>Profile Photo</h3>
                    <p class="text">Your uploaded picture cannot be viewed by anyone except the people you choose to match with</p>
                </div>
                <div class="profile-option-content">
                    <ul>
                        <li>
                            <a href="#" class="delete confirm-box-close"><i class="fa fa-trash"></i></a>
                            <div class="text">Cancel</div>
                        </li>
                        <li>
                            <a href="#" class="profile-image-icon add"><i class="fa fa-image"></i></a>
                            <div class="text">Gallery</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  PROFILE MODAL ALERT END -->












<!--  DELETE PROFILE IMAGE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_user_profile_img_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete profile image?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="delete_user_profile_img_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE PROFILE IMAGE MODAL ALERT END -->









<!--  DELETE PROFILE IMAGE MODAL ALERT START -->
<section class="modal-alert-popup" id="block_member_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to block <b>{{ $user->user_name }}</b> ?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="block_member_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE PROFILE IMAGE MODAL ALERT END -->






