







// *********** BOTTOM ALERT DANGER ****************//
function bottom_alert_error(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_danger").children('.bottom-alert-danger')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })

    setTimeout(function(){
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

    setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}











$(document).ready(function(){
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
    suspend = $(this).children()
    online_member = $(this).parent().parent().children('.avatar-parent').children().children()
    
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
var approve_member = null;
$(".approve-confirm-box-open").click(function(e){
    e.preventDefault()
    
    approve_member = $(this).parent()
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
                $(approve_member).hide()
                bottom_alert_success('User has been approved!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#approve_user_modal_popup_box").hide()
        }, 
        error: function(){
            $("#approve_user_modal_popup_box").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})







// ************ DEACTIVATE / ACTIVATE MEMBER OPEN MODAL **********//
var deactivate_member = null;
$(".deactivate-confirm-box-open").click(function(e){
    e.preventDefault()

    deactivate_member = $(this);
    online_member = $(this).parent().parent().parent().parent().parent().children('.avatar-parent').children().children()
    
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
                $(online_member).removeClass('active')
                $(deactivate_member).html('Activate')
                $(deactivate_member).toggleClass('active')
                bottom_alert_success('User has been deactivated!')
            }else if(response.activated){
                $(deactivate_member).html('Deactivate')
                $(deactivate_member).toggleClass('active')
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


































// end
})

