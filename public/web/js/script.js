$(document).ready(function(){

// ********** REMOVE MAIN PAGE PRELOADER **********//
function remove_main_page_preloader(){
    $("#main_app_preloader").fadeOut(300)
}
setTimeout(function(){
    remove_main_page_preloader()
}, 1000)







// ********** SLIDER ***********//
var n = 1;
var page_slider_container = $(".slider-container");

function page_slider(){
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








    // end of document
});