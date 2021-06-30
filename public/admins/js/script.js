

// *********** BOTTOM ALERT DANGER ****************//
var time;
function bottom_alert_error(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_danger").children('.bottom-alert-danger')

    

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })
    var newBottom = parseInt($(alert).css('bottom'));
    
    if(newBottom >= 0){
        $(alert).css({
            bottom: '-100px'
        })
        return clearTimeout(time)
    }

    time = setTimeout(function(){
            $(alert).css({
                bottom: '-100px'
            })
        }, 4000)
}








// *********** BOTTOM ALERT SUCCESS ****************//
function bottom_alert_success(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_success").children('.bottom-alert-success')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })
    var newBottom = parseInt($(alert).css('bottom'));
    
    if(newBottom >= 0){
        $(alert).css({
            bottom: '-100px'
        })
        return clearTimeout(time)
    }

    time = setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}











$(document).ready(function(){

// ******************* NOTIFICATION ALERT ************//
function nav_notification_alert(){
    var url = $("#admin_notification_alert").attr('data-url')

    if(url.length == 0) return

    csrf_token() //csrf token
    
    $.ajax({
        url: url,
        method: "post",
        data: {
            notification: 'notification',
        },
        success: function (response){
            if(response.data){
                $(".admin_notification_alert").html(response.data)
                $("#admin_notification_alert").addClass('noti-icon-badge')
            }else{
                $(".admin_notification_alert").html('')
                $("#admin_notification_alert").removeClass('noti-icon-badge')
            }
        }
    });


    setTimeout(function(){
        nav_notification_alert()
    }, 10000)
}

nav_notification_alert()





function unseen_nav_notification(){
    var url = $("#navigation_notification_body").attr('data-url')

    if(url.length == 0) return

    csrf_token() //csrf token
    
    $.ajax({
        url: url,
        method: "post",
        data: {
            notification: 'notification',
        },
        success: function (response){
            $("#navigation_notification_body").html(response)
        }
    });

    setTimeout(function(){
        unseen_nav_notification()
    }, 10000)
}


unseen_nav_notification()







// *********** LOGOUT DARKSKIN CANCLE ***********//
$(window).click(function(e){
    if($(e.target).hasClass('logout-preloader-dark-theme')){
        $("#logout_preloader_container").hide();
    }
})





// ************ LOGOUT MODAL OPEN ************//
$(".logout_modal_open_btn").click(function(e){
    e.preventDefault();
    $("#logout_preloader_container").show();
})






// *********** LOGOUT MODAL BTN CANCLE ***********//
$("#logout_user_cancle_btn").click(function(e){
    e.preventDefault()
    $("#logout_preloader_container").hide()
})







// ********** LOGOUT USER *************//
$("#logout_admin_user_submit").click(function(e){
    e.preventDefault()
    var url = $(this).attr('href')
    $("#logout_preloader_container").hide()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            logout: 'logout'
        },
        success: function (response){
            if(response.data){
                location.assign(response.data)
            }else{
                location.reload()
            }
        }
    });
   
})







// ********* OPEN DROP DOWN **********//
$(window).click(function(e){
    $('ul.drop-down-body').hide()
    if($(e.target).hasClass('drop-down-open') || $(e.target).hasClass('drop-down-body')){
        $(e.target).parent().children('ul.drop-down-body').show()
    }
})





// ********* PRELOADER ONLOAD **************//
function remove_app_preloader(){
    setTimeout(function(){
        $("#app_preloader_container").hide()
    }, 1000)
}
remove_app_preloader()









// ********* CLOSE CONFIRM BOX *********//
$(".confirm-box-close").click(function(e){
    e.preventDefault()
    $(".modal-alert-popup").hide()
})



// ********* DARK SKIN CLOSE CONFIRM BOX *********//
$(window).click(function(e){
    if($(e.target).hasClass('sub-confirm-dark-theme'))
    {
        $(".modal-alert-popup").hide()
    }
})





// *********** OPEN CONFRIM MODAL **********//
$('.open-modal-btn').click(function(e){
   $("#confirm_modal_popup").show()
})




// ********* CLOSE DETAIL MODAL **********//
$(".modal-btn-close").click(function(e){
    e.preventDefault()
    $(".modal-popup-container").hide()
})




//******* CLOSE FORM MODAL ******/
$(window).click(function(e){
    if($(e.target).hasClass('dark-theme-modal-popup')){
        $('.modal-popup-container').hide()
    }
})





// *********** OPEN CONFRIM MODAL **********//
$('.suspend-confirm-box-open').click(function(e){
    e.preventDefault()
   $("#confirm_modal_popup_box").show()
})




var suspend = null;
var online_member = null;
$(".suspend-confirm-box-open").click(function(e){
    e.preventDefault()
    suspend = $(this).parent();
    online_member = $(this).parent().parent().parent().children('.avatar-parent').children().children()
    
    var user_id = $(this).attr('id')
    var name = $(this).attr('data-name')
    $("#member_suspend_id_input").val(user_id)
    $("#suspend_confirm_submit_btn").html('Proceed')
    
    if($(suspend).hasClass('active')){
        apend_message('<p>Do you wish to unsuspend <b>'+name+'</b></p>')
    }else{
        apend_message('<p>Do you wish to suspend <b>'+name+'</b></p>')
    }
})




// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#confirm_modal_popup_box").find('.confirm-header').html(message)
    $("#approve_user_modal_popup_box").find('.confirm-header').html(message)
    $("#deactivate_user_modal_popup_box").find('.confirm-header').html(message)
}






// ********** SUSPEND MEMBER / UNSUSPEND MEMBER***************//
$("#suspend_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var url = $(this).attr('data-url')
    var user_id = $("#member_suspend_id_input").val()
    $("#suspend_confirm_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.suspended){
                $(suspend).toggleClass('active')
                $(online_member).removeClass('active')
                bottom_alert_success('User has been suspended!')
            }else if(response.unsuspended){
                $(suspend).toggleClass('active')
                bottom_alert_success('User has been unsuspended!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#confirm_modal_popup_box").hide()
        }, 
        error: function(){
            $("#confirm_modal_popup_box").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})






// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}






// *********** OPEN APPROVE MEMBER MODAL *************//
var approve_parent_div = null;

$(".approve-confirm-box-open").click(function(e){
    e.preventDefault()
    
    approve_member = $(this).parent()
    approve_parent_div = $(this).parent().parent().parent().parent().parent()
    var user_id = $(this).attr('id')
    var name = $(this).attr('data-name')
    $("#member_approve_id_input").val(user_id)
    $("#approve_user_modal_popup_box").show()
    $("#approve_confirm_submit_btn").html('Proceed')
    apend_message('<p>Do you wish to approve <b>'+name+'</b></p>')
})





// ************ APPROVE MEMBER ****************//
$("#approve_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var url = $(this).attr('data-url')
    var user_id = $("#member_approve_id_input").val()
    $("#approve_confirm_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data){
                $(approve_parent_div).remove()
                table_check()
                bottom_alert_success('User has been approved!')
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







// ************ DEACTIVATE / ACTIVATE MEMBER OPEN MODAL **********//

var parent_div = null;

$(".deactivate-confirm-box-open").click(function(e){
    e.preventDefault()

    parent_div = $(this).parent().parent().parent().parent().parent()
    
    var user_id = $(this).attr('id')
    var name = $(this).attr('data-name')
    $("#member_approve_id_input").val(user_id)
    $("#deactivate_user_modal_popup_box").show()
    $("#deactivate_confirm_submit_btn").html('Proceed')
    
    if($(this).hasClass('active')){
        apend_message('<p>Do you wish to activate <b>'+name+'</b></p>')
    }else{
        apend_message('<p>Do you wish to deativate <b>'+name+'</b></p>')
    }
    
})






// ********* DEACTIVATE MEMBER **************//
$("#deactivate_confirm_submit_btn").click(function(e){
    e.preventDefault()

    var url = $(this).attr('data-url')
    var user_id = $("#member_approve_id_input").val()
    $("#deactivate_confirm_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.deactivated){
                $(parent_div).remove()
                table_check()
                bottom_alert_success('User has been deactivated!')
            }else if(response.activated){
                $(parent_div).remove()
                table_check()
                bottom_alert_success('User has been activated!')
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









// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#parent_table").children()
    if(table.length == 0){
        $("#bottom_table_part").html("<div class='text-center'>There are no members yet!</div>")
    }
}










// ********* CLEAR ALL NOTIFICATION MODAL OPEN **************//
$(".admin-clear-all-notification").click(function(e){
    e.preventDefault()
    $("#clear_notification_modal_popup_box").show()
})






//********* CLEAR ALL NOTIFICATION **************//
$("#clear_notification_confirm_submit_btn").click(function(e){
    e.preventDefault()

    var url = $(this).attr('data-url')
    var notification_body = $("#notification_body")
    $("#clear_notification_confirm_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            notifications: 'notifications',
        },
        success: function (response){
            if(response.empty)
            {
                bottom_alert_error('Notification is empty!')
            }else if(response.data){
                if(notification_body.length > 0){
                    $(notification_body).html(' <div class="text-center pt-3">There are no notifications yet!</div>')
                }
                bottom_alert_success('Notification delete successfully!')
                $("#navigation_notification_body").html('<div class="text-center pt-3">There are no unseen notifications</div>')
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










// ************* ADD USER SUBSCRIPTION *************//
var user_id = null;
$(".add-user-subscription-btn").click(function(e){
    e.preventDefault()
    user_id = $(this).attr('id')
    $('.alert_sub_inputs').html('')
    $("#add_subscription_modal_popup_box").show()
})




$("#add_user_subscription_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $('.alert_sub_inputs').html('')
    var url = $(this).attr('data-url')
    var type = $("#add_user_type_input").val()
    var amount = $("#add_suser_sub_amount").val()
    $(this).html('Please wait...')

    if(!type){
        $('.alert_sub_inputs').html('*All fields are required')
        $("#add_user_subscription_confirm_submit_btn").html('Proceed')
        return
    }
    
    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            type: type,
            user_id: user_id,
            amount: amount
        },
        success: function (response){
            if(response.error){
                $('.alert_sub_inputs').html(response.error.all)
            }else if(response.data){
               location.reload()
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
















// ********** SEND NEWSLETTER MODAL OPEN ************//

var newsletter_id;
$("#parent_table_container").on('click', '.send-newsletter-modal-open', function(e){
    e.preventDefault()
    newsletter_id = $(this).attr('id')
    $("#send_newesletter_modal_popup_box").show()
    $("#send_newsletter_confirm_submit_btn").html('Proceed')
})






// ************* SEND NEWSLETTER *********** //
$("#send_newsletter_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var url = $(this).attr('data-url')
    $(this).html("Please wait...")

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            newsletter_id: newsletter_id
        },
        success: function (response){
            if(response.error){
                bottom_alert_error(response.error)
            }else if(response.data){
                bottom_alert_success('Newsletter sent successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
            console.log(response)
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})






// end
})















