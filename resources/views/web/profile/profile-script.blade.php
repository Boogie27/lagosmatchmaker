




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








// ******** OPEN AVATAR MODAL ************//
var avatar_state = false;
$("#profile_img_upload_btn").click(function(e){
    e.preventDefault()
    if(!avatar_state){
        fetch_all_avatar()
    }else{
        $("#avatar_popup_section").show()
    }
})


// *********** FECTH ALL AVATARS ************//
function fetch_all_avatar(){
    var url = $('#profile_img_upload_btn').attr('href')
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            fetch_all_avatar: 'fetch_all_avatar'
        },
        success: function (response){
            if(!response.data){
                $("#access_preloader_container").hide()
            }
            avatar_state = true;
            $("#avatar_body_container").html(response)
            $("#avatar_popup_section").show()
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#access_preloader_container").hide()
        }
    });
}











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
        apend_message('<p>Signup or Login to like <br><b>'+display_name+'</b></p>')
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
$(".user_like_confirm_modal_popup").click(function(e){
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
                apend_message('<p>Subscribe to premium to like <br><b>'+display_name+'</b></p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.like_this_user){
                location.reload()
            }else if(response.subscribe){
                apend_message('<p>Subscribe to like <b>'+display_name+'</b></p>')
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
                apend_message('<p>Subscribe to premium to accept <br><b>'+display_name+'</b> request</p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.matched){
               get_matched_modal(user_id)
               var ulikeBtn = ' <li><a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart"></i> Unlike</a></li>';
               $("#user_like_action_btns").append(ulikeBtn);
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
                $("#matched_detail_modal_popup").html(response)
                $("#profile_match_section").show()
                $("#access_preloader_container").hide()
            }
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
                $(".notification-users-icon").append('<span class="badge bg-danger">'+response.data+'</span>')
            }else{
                $(".notification-users-icon").html('')
            }
        },
    }); 
}






// *************** UNLIKE A USER MODAL CONFRIM**************//
$("#user_like_action_btns").on('click', '#user_unlike_confirm_modal_popup', function(e){
    e.preventDefault()
    var display_name = $(".user-display-name").html()

    $("#unlike_user_modal_popup").find('.confirm-header').html(' <p>Do you wish to unlike <b>'+display_name+'</b></p>')
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













// end
})
</script>

