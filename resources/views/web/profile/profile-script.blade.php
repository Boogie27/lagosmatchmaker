




<!--**********************AJAX  USER ID ******************-->
<a href="#" data-id="{{ $user->id }}" data-email="{{ $user->email }}" id="ajax_user_id_input_anchor" style="display: none;"></a>
<a href="{{ current_url() }}" id="current_url_input" style="display: none;"></a>
<input type="text" id="user_id_input_box" value="{{ $user->id }}" style="display: none;">









<script>
$(document).ready(function(){
// ********* OPEN VIDEO CALL **********//
$("#video_call_open_btn").click(function(e){
    e.preventDefault()
    $("#video_call_section").show()
})



// ********* CLOSE VIDEO CALL ***********//
$("#video_call_close_btn").click(function(e){
    e.preventDefault()
    $("#video_call_section").hide()
})



// ********* OPEN VIDEO CALL SUBSCRIPTION MODAL *********//
$("#video_membership_sub_open_btn").click(function(e){
    e.preventDefault()
    $("#membership_sub_modal_popup").show()
})







// ********* CLOSE PROFILE MATCH ***********//
$("#profile_match_close_btn").click(function(e){
    e.preventDefault()
    $("#profile_match_section").hide()
})






//******* CLOSE FORM MODAL ******/
$('.modal-btn-close').click(function(e){
    e.preventDefault()
    $('.modal-popup-container').hide()
})






//******* CLOSE FORM MODAL ******/
$(window).click(function(e){
    if($(e.target).hasClass('dark-theme-modal-popup')){
        $('.modal-popup-container').hide()
    }
})






// ********* EDIT DEATIL INFO ***********//
$("#detail_info_edit_btn_open").click(function(e){
    e.preventDefault()
    $("#edit_detail_info_section").show()
})



// ********* REPORT MEMBER MODAL OPEN ***********//
$("#report_modal_open_btn").click(function(e){
    e.preventDefault()
    $("#report_member_section").show()
})




// ********* OPEN ABOUT ME MODAL ***********//
$("#about_me_edit_btn_open").click(function(e){
    e.preventDefault()
    $("#about_me_edit_btn_modal").show()
})




// ********* OPEN LOOKINF FOR MODAL ***********//
$("#looking_for_btn_open").click(function(e){
    e.preventDefault()
    $("#looking_for_modal_popup").show()
})



// ********* OPEN LIFSTYLE MODAL ***********//
$("#detail_lifestyle_btn_open").click(function(e){
    e.preventDefault()
    $("#lifestyle_modal_popup").show()
})




// ********* OPEN PHYSICAL MODAL ***********//
$("#detail_physical_info_btn_open").click(function(e){
    e.preventDefault()
    $("#physical_info_modal_popup").show()
})







// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}









// ************ DISPLAYS MESSAGE ON MODAL IF NOT LOGGED IN***************//
$(".login_confirm_modal_popup").click(function(e){
    e.preventDefault()
    var button = $(this).children()
    var display_name = $(".user-display-name").html()
   
    if($(button).hasClass('fa-heart')){
        apend_message('<p>Signup or Login to match with <br><b>'+display_name+'</b></p>')
    }
    if($(button).hasClass('fa-comment')){
        apend_message('<p>Signup or Login to message <br><b>'+display_name+'</b></p>')
    }
    if($(button).hasClass('fa-video')){
        apend_message('<p>Signup or Login to call <br><b>'+display_name+'</b></p>')
    }
    $("#login_confirm_modal_popup").show()
    $("#login_confirm_submit_btn").html('Proceed')
})




function apend_message(message){
    $("#login_confirm_modal_popup").find('.confirm-header').html(message)
    $("#membership_sub_modal_popup").find('.confirm-header').html(message)
    $("#block_member_modal_popup_box").find('.confirm-header').html(message)
    $("#unmatch_member_modal_popup_box").find('.confirm-header').html(message)
    $("#cancel_member_request_modal_popup_box").find('.confirm-header').html(message)
    $("#delete_sent_request_modal_popup_box").find('.confirm-header').html(message)
}



// ********* REDIRECTS TO LOGIN **************//
$("#login_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    var current_url = $("#current_url_input").attr('href')

    $(this).html("Please wait...")

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-login-check') }}",
        method: "post",
        data: {
            user_id: user_id,
            current_url: current_url
        },
        success: function (response){
            if(response.data){
                location.assign(response.data)
            }
            $("#login_confirm_modal_popup").hide()
        }, 
        error: function(){
            $("#login_confirm_modal_popup").hide()
        }
    });
})









// **************** LIKE A USER *********************//
$("#user_like_action_btns").on('click', '.user_like_confirm_modal_popup', function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    var display_name = $(".user-display-name").html()
    var current_url = $("#current_url_input").attr('href')
    $("#access_preloader_container").show()
    $("#subscribe_to_plan_submit_btn").html('Subscribe Now')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-like-user') }}",
        method: "post",
        data: {
            user_id: user_id,
            current_url: current_url
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to match with <br><b>'+display_name+'</b></p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.like_this_user){
                location.reload()
            }else if(response.subscribe){
                apend_message('<p>Subscribe to match with <b>'+display_name+'</b></p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.daily_count_completed){
                $("#access_preloader_container").hide()
                bottom_alert_error(`your daily matches is completed`)
            }
            console.log(response)
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
})








// ************** SEND USER TO SUBSCRIPTION PAGE ******************//
$("#subscribe_to_plan_submit_btn").click(function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    var current_url = $("#current_url_input").attr('href')
    $("#subscribe_to_plan_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-subscribe-to-plan') }}",
        method: "post",
        data: {
            user_id: user_id,
            current_url: current_url
        },
        success: function (response){
           location.assign(response.data)
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
})







// ************* CANCLE LIKE **********//
$(".user-cancle-like-request-btn").click(function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-cancle-like-request') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data){
                location.reload()
            }
            $("#access_preloader_container").hide()
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
})








// *************** ACCPET A REQUEST ******************//
$(".user-accept-like-btn").click(function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    var display_name = $(".user-display-name").html()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-accept-like-request') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to accept <br><b>'+display_name+'</b> match</p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.matched){
                $(".profile-image-img img").attr('src', response.avatar)
                get_matched_modal(user_id)
                get_profile_likns(user_id)
            //    var ulikeBtn = ' <li><a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart"></i> Unmatch</a></li>';
            //    $("#user_like_action_btns").append(ulikeBtn);
            }else{
                $("#access_preloader_container").hide()
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
})




// ********GET MATCHED MODAL ************//
function get_matched_modal(user_id){
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-matched-detail') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data == false){
                location.reload()
            }else{
                get_user_alert()
                $(".action-like-btn").hide()
                $("#add_match_members_profile").html(response)
                $("#profile_match_open_btn").show()
                $("#access_preloader_container").hide()
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
}






// ********** GET PROFILE LINKS **************//
function get_profile_likns(user_id){
    $.ajax({
        url: "{{ url('/ajax-get-profile-links') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data == false){
                location.reload()
            }
            $("#user_like_action_btns").html(response)
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
}





// ************** GET USER ALERT *************//
function get_user_alert(){
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-users-notification-count') }}",
        method: "post",
        data: {
            user_alert: 'user_alert',
        },
        success: function (response){
            if(response.data){
                $(".notification_users_icon_js").append('<span class="badge bg-danger">'+response.data+'</span>')
            }else{
                $(".notification_users_icon_js").html('')
            }
        },
    }); 
}






// *************** UNLIKE A USER MODAL CONFRIM**************//
$("#user_like_action_btns").on('click', '#user_unlike_confirm_modal_popup', function(e){
    e.preventDefault()
    var display_name = $(".user-display-name").html()

    $("#unlike_user_modal_popup").find('.confirm-header').html(' <p>Do you wish to unmatch <b>'+display_name+'</b></p>')
    $("#unlike_user_modal_popup").show()
    $("#unlike_user_modal_submit_btn").html('Proceed')
})








// ************ UNLIKE A USER ******************//
$("#unlike_user_modal_submit_btn").click(function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    $("#unlike_user_modal_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-unlike-matched-user') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            location.reload()
        }, 
        error: function(){
            $("#user_unlike_confirm_modal_popup").hide()
        }
    });
})









// **********************************************************************************************************************//
// **************************** USER VIDEO CALL SECTION ******************************************************************//

// **********CALL A USER ***************//
$("#user_video_call_modal_popup").click(function(e){
    e.preventDefault()
    var user_id = $("#user_id_input_box").val()
    var display_name = $(".user-display-name").html()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-call-user') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to call <br><b>'+display_name+'</b></p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.subscribe){
                apend_message('<p>Subscribe to call <b>'+display_name+'</b></p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }

            console.log(response)
        }, 
        error: function(){
            $("#access_preloader_container").hide()
        }
    });
})








// ********* OPEN PROFILE IMAGE OPTION *********//
$(".profile-image-option").click(function(e){
    e.preventDefault()
    $("#profile_img_option_modal_popup_box").show()
})




// ************ OPEN IMAGE INPUT **************//
var cropper = null;
var canvas = null;
$(".profile-image-icon").click(function(e){
    e.preventDefault()

     if(cropper)
    {
        cropper.destroy();
        cropper = null;
    }

    $("#profile_image_input").val('')
    $("#profile_image_input").click()
})



// *********** UPLOAD IMAGE TO CROPPER ***********//
var image = $("#cropper_sample_img")
$("#profile_image_input").change(function(e){
    var file = e.target.files
    var extension = file[0].type;
    var type = extension.split('/')[1]
    $("#profile_img_option_modal_popup_box").hide()
    
    if(type != 'jpeg' && type != 'png'){
        $("#profile_image_input").val('')
        return bottom_alert_error('Image type must be jpg, jpeg, png!')
    }

    var done = function(url){
        $(image).attr('src', '');
        $(image).attr('src', url)
        $("#cropper_modal_popup_box").show()
    }

    if(file && file.length > 0){
        reader = new FileReader()
        reader.onload = function(event){
            done(reader.result)
        }
        reader.readAsDataURL(file[0])
    }
})











// DISPLAY IMAGE CROPPER ON IMAGE
function image_cropper(){
    $(image).on('load', function(e){
        cropper = new Cropper(e.target, {
            aspectRatio: 1,
            viewMode: 3
        });
    });
}
image_cropper(); //crop image




// CROP IMAGE
$("#cropper_confirm_submit_btn").click(function(e){
    e.preventDefault();
    canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500
        });

    canvas.toBlob(function(blob){
        var image_url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);

        reader.onloadend = function(){
            var base64data = reader.result;
            upload_image(base64data);
        }
    });
});






// UPLOAD CROPPED IMAGE
function upload_image(base64data){
    $(".modal-alert-popup").hide()
    $("#access_preloader_container").show()

    csrf_token()   // gets page csrf token

    $.ajax({
        url: "{{ url('/ajax-add-profile-image') }}",
        method: "post",
        data: {
            image: base64data
        },
        success: function (response){
            if(response.data){
                $(".profile-image-img img").attr('src', response.data)
                bottom_alert_success('Profile image uploaded successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#profile_image_input").val('')
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#profile_image_input").val('')
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}











// ******** DELETE PROFILE IMAGE MODAL OPEN ************//
$("#open_profile_image_delete").click(function(e){
    e.preventDefault()
    $("#profile_img_option_modal_popup_box").hide()
    $("#delete_user_profile_img_modal_popup_box").show()
    $("#delete_user_profile_img_confirm_submit_btn").html("Proceed")
})









// ******** DELETE PROFILE IMAGE ************//
$("#delete_user_profile_img_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')
    var btn = $(this);

     csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-delete-user-profile-image') }}",
        method: "post",
        data: {
            user_id: "{{ $user->id }}",
        },
        success: function (response){
            if(response.no_avatar){
                bottom_alert_error('Empty Profile Image!')
            }else if(response.data){
              console.log(response.data)
                $(".profile-image-img img").attr('src', response.data)
                bottom_alert_success('Profile image deleted successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})







// ********* BLOCK MEMBER MODAL OPEN ***********//
var name = "{{ $user->user_name }}";
$("#member_block_container").on('click', '#block_modal_open_btn', function(e){
    e.preventDefault()
  
    $("#block_member_modal_popup_box").show()
    $("#block_member_confirm_submit_btn").html('Proceed')
    apend_message('<p>Do you wish to block <br><b>'+name+'</b></p>')
})




// ********* UNBLOCK MEMBER MODAL OPEN ***********//
$("#member_block_container").on('click', '#unblock_modal_open_btn', function(e){
    e.preventDefault()
   
    $("#block_member_modal_popup_box").show()
    $("#block_member_confirm_submit_btn").html('Proceed')
    apend_message('<p>Do you wish to unblock <br><b>'+name+'</b></p>')
})







// ******** CANT MESSAGE  MEMBER BTN************//
$("#user_like_action_btns").on('click', '.cant-message-btn', function(e){
    e.preventDefault()
    bottom_alert_error("Can't message this member!")
})





// ******** BLOCK MEMBER ************//
$("#block_member_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

     csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-block-member') }}",
        method: "post",
        data: {
            user_id: "{{ $user->id }}",
        },
        success: function (response){
            if(response.data == 'unblocked'){
                bottom_alert_success(name+' has been unblocked')
                $("#member_block_container").html('<a href="#" id="block_modal_open_btn" class="report-btn">Block</a>')
            }else if(response.data == 'blocked'){
                bottom_alert_success(name+' has been blocked')
                $("#member_block_container").html('<a href="#" id="unblock_modal_open_btn" class="report-btn">Unblock</a>')
            }else{
                bottom_alert_error('Network error, try again later!')
            }

            if(response.is_blocked){
                $("#li_like_member_btn").html('')
                if(response.is_matched){
                    $("#cant_message_member_btn").html('<a href="#" class="cant-message-btn text-danger"><i class="far fa-comment"></i> Message</a>')
                }
            }else{
                if(response.is_matched){
                    $("#li_unlike_member_btn").html('<a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Unmatch</a>')
                    $("#cant_message_member_btn").html('<a href="{{ url("/chat/".$user->id) }}"><i class="far fa-comment"></i> Message</a>')
                }else{
                    $("#li_like_member_btn").html('<a href="#" class="user_like_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Match</a>')
                }
           }

            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})









// ************ DISPLAY DAILY MATCH REQUEST ****************//
$("#daily_matche_request").click(function(e){
    e.preventDefault()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-daily-match-request') }}",
        method: "post",
        data: {
           daily_request: 'daily_request'
        },
        success: function (response){
            $("#matches_request_container").html(response)
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})








// ********** UNMATCH MEMBER *************//
var username
var like_id
var parent
$("#matches_request_container").on('click', '.unmatch-user-button', function(e){
    e.preventDefault()
    like_id = $(this).attr('id')
    username = $(this).attr('data-name')
    parent = $(this).parent().parent().parent().parent().parent().parent()
    apend_message('<p>Do you wish to unmatch <b>'+username+'</b></p>')
    $("#unmatch_member_modal_popup_box").show()
    $("#unmatch_member_confirm_submit_btn").html('Proceed')
})




$("#unmatch_member_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var match_counter = $("#matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-umatch-member') }}",
        method: "post",
        data: {
            like_id: like_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)

                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>My Matches ( <span>0</span> )</h3>
                                            <p>Members who you matched with you</p>
                                        </div>
                                        <div class="note-text">You have no matches!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})








// ************ FETCH USER MATCHES ************//
$("#fetch_user_matches_btn").click(function(e){
    e.preventDefault()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-fetch-user-matches') }}",
        method: "post",
        data: {
        fetch_matches: 'fetch_matches'
        },
        success: function (response){
            $("#matches_request_container").html(response)
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})










// ************ CANCEL MATCH REQUEST *************//
$("#matches_request_container").on('click', '.cancel-user-request-button', function(e){
    e.preventDefault()
    like_id = $(this).attr('id')
    username = $(this).attr('data-name')
    parent = $(this).parent().parent().parent().parent().parent().parent()
    $("#cancel_member_request_modal_popup_box").show()
    apend_message('<p>Do you wish to unmatch <b>'+username+'</b></p>')
    $("#cancel_member_request_confirm_submit_btn").html('Proceed')
})





$("#cancel_member_request_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

    var match_counter = $("#matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-cancel-match-request') }}",
        method: "post",
        data: {
            like_id: like_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)

                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>My Matches ( <span>0</span> )</h3>
                                            <p>Members who would love to match with you</p>
                                        </div>
                                        <div class="note-text">You have no match requests!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})












// ************ FETCH MATCH REQUEST *************//
$("#member_match_request_btn").click(function(e){
    e.preventDefault()

    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-fetch-member-matches-request') }}",
        method: "post",
        data: {
            fetch_member_matches: 'fetch_matches'
        },
        success: function (response){
            $("#matches_request_container").html(response)
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})









// ************** ACCEPT FRIEND REQUEST **************//
$("#matches_request_container").on('click', '.accept-friend-request-btn', function(e){
    e.preventDefault()
    user_id = $(this).attr('id')
    parent = $(this).parent().parent().parent().parent().parent().parent()
    var match_counter = $("#matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 
    
    var display_name = $(".user-display-name").html()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-accept-like-request') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to accept <br><b>'+display_name+'</b> match</p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.matched){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)
                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>Match Request ( <span>0</span> )</h3>
                                            <p>Members who would love to match with you</p>
                                        </div>
                                        <div class="note-text">You have no match requests!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
                get_matched_modal(user_id)
               
            }else{
                $("#access_preloader_container").hide()
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
})







// *************** FETCH SENT REQUEST ************//
$("#user_sent_request_btn").click(function(e){
    e.preventDefault()

    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-fetch-user-sent-request') }}",
        method: "post",
        data: {
            fetch_sent_request: 'fetch_sent_request'
        },
        success: function (response){
            $("#matches_request_container").html(response)
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})










// ************ CANCEL MATCH REQUEST *************//
$("#matches_request_container").on('click', '.delete-user-request-button', function(e){
    e.preventDefault()
    like_id = $(this).attr('id')
    username = $(this).attr('data-name')
    parent = $(this).parent().parent().parent().parent().parent().parent()
    $("#delete_sent_request_modal_popup_box").show()
    apend_message('<p>Do you wish to cancel match request with <b>'+username+'</b></p>')
    $("#delete_sent_request_confirm_submit_btn").html('Proceed')
})






$("#delete_sent_request_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

    var match_counter = $("#matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-cancel-match-request') }}",
        method: "post",
        data: {
            like_id: like_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)

                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>Sent Request ( <span>0</span> )</h3>
                                            <p>Members who you love to match with you</p>
                                        </div>
                                        <div class="note-text">You have no sent requests!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})


// end
})
</script>

