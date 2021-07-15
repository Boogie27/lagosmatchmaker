

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

// ********** REMOVE MAIN PAGE PRELOADER **********//
function remove_main_page_preloader(){
    $("#main_app_preloader").fadeOut(300)
}
setTimeout(function(){
    remove_main_page_preloader()
}, 1000)






// ************* SCROLL TOP BANNER ************//
function scroll_top_banner(){
    $(window).scroll(function(){
        var height = $(this).scrollTop()
        if(height > 10){
            $(".top-banner-inner").addClass('top')
        }else{
            $(".top-banner-inner").removeClass('top')
        }
    })

    if($(window).scrollTop() > 10){
        $(".top-banner-inner").addClass('top')
    }
}
scroll_top_banner()






// *********** CLOSE TOP BANNER ALERT *************//
$(".top-banner-cancle-btn").click(function(){
    $(".top-banner-alert").hide(200)
})





// ********** SLIDER ***********//
var n = 1;
var page_slider_container = $(".slider-container");

function page_slider(){
    if(page_slider_container.length <= 0) return;
    
    sliders = $(page_slider_container).children() 
    var total_slide = sliders.length; 
    var duration = $(page_slider_container).attr('data-duration')

    for(var i = 0; i < sliders.length; i++){
        $(sliders[i]).css({
            opacity: '0'
        })
    }

    if(n > total_slide){
        n = 1;
    }
 
    $(sliders[n - 1]).css({
        opacity: '1'
    })
    n++;

    setTimeout(function(){
        page_slider()
    }, duration)
}

page_slider()








// ********** BOOTSTARP SELECT *********//
$('select').selectpicker();





// ********** OPEN SIDE NAVIGATION ************//
$(".side-navigation-open-button").click(function(e){
    e.preventDefault()
    open_mobile_navigation()
})

function open_mobile_navigation(){
    $("#side_dark_theme").show()
    $("#side_nav_content").css({
        left: '0px',
    })
}








// ********** CLOSE SIDE NAVIGATION ************//
$("#side_nav_close").click(function(e){
    e.preventDefault()
    close_mobile_navigation()
})

function close_mobile_navigation(){
    $("#side_dark_theme").hide()
    $("#side_nav_content").css({
        left: '-500px',
    })
}








// ********** CLICK DARK SKIN TO CLOSE SIDE NAVIGATION ************//
function darkskin_close_mobile_navigation(){
    $("#side_dark_theme").click(function(){
        $("#side_nav_close").click()
    })
}
darkskin_close_mobile_navigation()





// ********* SCROLL TO TOP EFFECT ************//
function scroll_to_top(){
    var scrollTop = $(".angle-up-container");
    
    var elementTop = $(window).scrollTop();
    var footerContainer = $(scrollTop).offset().top;
    var inview = $(window).height();
    var difference = ((footerContainer - elementTop));

    if(difference < inview){
        $(scrollTop).children().fadeIn();
    }else{
        $(scrollTop).children().fadeOut();
    }

    // angle up onscroll effect
    // ============================
    $(window).scroll(function(){
        var elementTop = $(this).scrollTop();
        var difference = ((footerContainer - elementTop));
        if(difference < inview){
            $(scrollTop).children().fadeIn();
        }else{
            $(scrollTop).children().fadeOut();
        }
    });
}
if($(".angle-up-container").length){
    scroll_to_top()
}











function bottom_error_danger(string){
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






function bottom_success_danger(string){
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









// ********* SMOOTH SCROLL UP *************//
$("#smooth_scroll_btn").click(function(e){
    e.preventDefault()
    $("html, body").animate({
        scrollTop: '0'
    }, 700);
})










// *********** LOGOUT DARKSKIN CANCLE ***********//
$(window).click(function(e){
    if($(e.target).hasClass('logout-preloader-dark-theme')){
        $("#logout_preloader_container").hide();
    }
})





// ************ LOGOUT MODAL OPEN ************//
$("#logout_modal_open_btn").click(function(e){
    e.preventDefault();
    $("#logout_preloader_container").show();
})






// *********** MOBILE LOGOUT MODAL BTN CANCLE ***********//
$("#mobile_logout_modal_open_btn").click(function(e){
    e.preventDefault()
    close_mobile_navigation()
    $("#logout_preloader_container").show();
})







// *********** LOGOUT MODAL BTN CANCLE ***********//
$("#logout_user_cancle_btn").click(function(e){
    e.preventDefault()
    $("#logout_preloader_container").hide()
})







// ********** LOGOUT USER *************//
$("#logout_user_btn").click(function(e){
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
            location.reload()
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







// ********** REMOVE ALERT **************//
if($('.main-alert-toggle').length){
    setTimeout(function(){
        $('.main-alert-toggle').fadeOut(100)
    }, 5000)
}








// ********* CLOSE SUBSCRIPTION CONFIRM BOX *********//
$(".confirm-box-close").click(function(e){
    e.preventDefault()
    $(".modal-alert-popup").hide()
})



// ********* DARK SKIN CLOSE SUBSCRIPTION CONFIRM BOX *********//
$(window).click(function(e){
    if($(e.target).hasClass('sub-confirm-dark-theme'))
    {
        $(".modal-alert-popup").hide()
    }
})






//******* CLOSE FORM MODAL ******/
$(window).click(function(e){
    if($(e.target).hasClass('dark-theme-modal-popup')){
        $('.modal-alert-popup').hide()
    }
})









// *********** OPEN MODAL POPUP *************//
$(window).click(function(e){
    if($(e.target).attr('data-modal'))
    {
        e.preventDefault()
        var id = $(e.target).attr('data-modal');
        $(id).show()
    }
})







// *********** DROP DOWN BOX ****************//
$(window).click(function(e){
    $('.drop-down-body').hide()
    if($(e.target).hasClass('drop-down-btn') || $(e.target).hasClass('drop-down-body')){
        $(e.target).parent().children('.drop-down-body').show()
    }
    if($(e.target).hasClass('drop-down-header')){
        $(e.target).parent().parent().children('.drop-down-body').show()
    }
})








// ************** MEMBERSHIP ANGLE DOWN **************//
$(".member_angle_down").click(function(e){
    e.preventDefault()
    var container = $(this).parent().parent().children('.member-info-container')
    var detail = $(container).children('ul.ul-member-body')

    $(container).animate({
        scrollTop: $(detail).height()
    })
})




// ************** MEMBERSHIP ANGLE UP **************//
$(".member_angle_up").click(function(e){
    e.preventDefault()
    var container = $(this).parent().parent().children('.member-info-container')
    var detail = $(container).children('ul.ul-member-body')

    $(container).animate({
        scrollTop: 0
    })
})







// ********* OPEN CONFIRM MODAL ***********//
$(".confirm_modal_popup").click(function(e){
    e.preventDefault()
   
    var button = $(this).children()
    var display_name = $(this).attr('data-name')
   
    if($(button).hasClass('fa-heart')){
        apend_message('<p>Signup or Login to like <br><b>'+display_name+'</b></p>')
    }
    if($(button).hasClass('fa-envelope')){
        apend_message('<p>Signup or Login to message <br><b>'+display_name+'</b></p>')
    }
    if($(button).hasClass('fa-video')){
        apend_message('<p>Signup or Login to call <br><b>'+display_name+'</b></p>')
    }

    $("#confirm_modal_popup").show()
    $(".login-confirm-submit-btn").html('Proceed')
})




function apend_message(message){
    $("#confirm_modal_popup").find('.confirm-header').html(message)
    $("#user_confirm_sub_modal_popup").find('.confirm-header').html(message)
}





// ******** ADD MESSAGE TO MODAL BUTTON **********//
$(".login-confirm-submit-btn").click(function(){
    $(".login-confirm-submit-btn").html('Please wait...')
})






// **************** LIKE A MEMBER *********************//
$("ul#ul_member_anchor").on('click', '.like-a-member-btn', function(e){
    e.preventDefault()
    var url = $(this).attr('href')
    var user_id = $(this).attr('id')
    var link_url = $(this).attr('data-links')
    var display_name = $(this).attr('data-name')
    var current_url = $(this).attr('data-url')

    var parent = $(this).parent().parent() 

    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
            current_url: current_url
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to like <br><b>'+display_name+'</b></p>')
                $("#user_confirm_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.like_this_user){
                // location.reload()
                get_member_links(link_url, user_id, parent)
                bottom_success_danger(display_name+' has been liked!')
            }else if(response.subscribe){
                apend_message('<p>Subscribe to like <b>'+display_name+'</b></p>')
                $("#user_confirm_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else{
                bottom_error_danger('Network error, try again later!')
                $("#access_preloader_container").hide()
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
           bottom_error_danger('Network error, try again later!')
        }
    });
})







function get_member_links(url, user_id, parent){
    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            $(parent).html(response)
            $("#access_preloader_container").hide()
        }
    });
}







// *************** UNLIKE A USER MODAL CONFRIM**************//
$("ul#ul_member_anchor").on('click', '.unlike-a-member-btn', function(e){
    e.preventDefault()
    var display_name = $(this).attr('data-name')
    var user_id = $(this).attr('id')

    $("#user_confirm_modal_popup").show()
    $("#user_unlike_id_input").val(user_id)
    $("#user_confirm_unlike_submit").html('Proceed')
    $("#user_confirm_modal_popup").find('.confirm-header').html(' <p>Do you wish to unlike <b>'+display_name+'</b>?</p>')
})






// ************ UNLIKE A USER ******************//
$("#user_confirm_unlike_submit").click(function(e){
    e.preventDefault()
    var url = $("#user_unlike_id_input").attr('data-url')
    var user_id = $("#user_unlike_id_input").val()
    $("#user_confirm_unlike_submit").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data){
                location.reload()
            }else{
                $("#user_confirm_modal_popup").hide()
                bottom_error_danger('Network error, try again later!')
            }
        }, 
        error: function(){
            $("#user_confirm_modal_popup").hide()
            bottom_error_danger('Network error, try again later!')
        }
    });
})









// ******** OPEN CANCLE A USER REQUEST MODAL ************//
$("ul#ul_member_anchor").on('click', '.cancle-user-like-request', function(e){
    e.preventDefault()
    var display_name = $(this).attr('data-name')
    var user_id = $(this).attr('id')

    $("#user_confirm_modal_popup").show()
    $("#user_unlike_id_input").val(user_id)
    $("#user_confirm_unlike_submit").html('Proceed')
    $("#user_confirm_modal_popup").find('.confirm-header').html(' <p>Do you wish to cancle <b>'+display_name+'</b> request?</p>')
})








// ******* ACCEPT USER REQUEST **********//
$("ul#ul_member_anchor").on('click', '.accept-user-like-request', function(e){
    e.preventDefault()
    var user_id = $(this).attr('id')
    var url = $(this).attr('href')
    var popup_url = $(this).attr('data-detail')
    var link_url = $(this).attr('data-links')
    var display_name = $(this).attr('data-name')

    var parent = $(this).parent().parent() 

    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to accept <br><b>'+display_name+'</b> request</p>')
                $("#user_confirm_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.matched){
                get_matched_modal(popup_url, user_id)
                get_member_links(link_url, user_id, parent)
            }else{
                $("#access_preloader_container").hide()
                bottom_error_danger('Network error, try again later!')
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
           bottom_error_danger('Network error, try again later!')
        }
    });
})













// ********GET MATCHED MODAL ************//
function get_matched_modal(url, user_id){
    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data == false){
                location.reload()
            }else{
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






// ********* CLOSE PROFILE MATCH ***********//
$("#add_match_members_profile").on('click', '.member_match_close_btn', function(e){
    e.preventDefault()
    $(".member-match-form-container").hide()
})









// ************* DELETE APPORVED NOTIFICATION *********//
$("#delete_approved_notification").click(function(e){
    var url = $(this).attr('data-url')
    var not_id = $(this).attr('data-id')


    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            not_id: not_id
        },
        success: function (response){
            console.log(response)
        }
    });
})

























    // end of document
});