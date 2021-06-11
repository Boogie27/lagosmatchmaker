
<!-- AVATAR MODAL POPUP START -->
<section class="toggle-popup-modal" id="banner_popup_section">
    <div class="banner-modal-container">
        <div class="banner-modal-dark-theme">
            <div class="banner-inner-content">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Profile banner</h4>
                    <p>Select your prefered profile banner</p>
                    <p class="uploading_alert_msg"></p>
                </div>
                <div class="banner-body-container" id="banner_body_container">
                    <!-- profile banner here using ajax -->
                </div>
                <div class="avatar-btn">
                    <a href="#" class="modal-btn-close">Cancle</a>
                    <a href="#" id="upload_profile_banner_btn" class="accept">Upload</a>
                    <input type="hidden" id="banner_id_input" value="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- AVATAR MODAL POPUP END -->








<script>
$(document).ready(function(){
// *********** SELECT PREVIEW BANNER *************//
$("#banner_body_container").on('click', '.banner-img', function(e){
    e.preventDefault()

    banner_id = $(this).attr('id')
    $("#banner_id_input").val(banner_id)
    var image_src = $(this).children('img').attr('src')
    $("#banner_preview_image").children('img').attr('src', image_src)
})




// ********* PROFILE BANNER MODAL OPEN *************//
$("#profile_banner_open").click(function(e){
    e.preventDefault()
    reset_msg()
    $("#access_preloader_container").show()

    csrf_token() //csrf token  
    
    $.ajax({
        url: "{{ url('/ajax-get-profile-banners') }}",
        method: "post",
        data: {
            banner: 'banner'
        },
        success: function (response){
            $("#banner_body_container").html(response)
            $("#access_preloader_container").hide()
            $("#banner_popup_section").show()
        }, 
        error: function(){
            
        }
    });
})







// ********** UPLOAD PROFILE BANNER **********//
$("#upload_profile_banner_btn").click(function(e){
    e.preventDefault()
    update_banner_image()
})


function update_banner_image(){
    banner_id =  $("#banner_id_input").val()
   
    $(".uploading_alert_msg").addClass('text-success')
    $(".uploading_alert_msg").removeClass('text-danger')
    $(".uploading_alert_msg").html('Uploading, please wait...')

    csrf_token() //csrf token  

    // $.ajax({
    //     url: url,
    //     method: "post",
    //     data: {
    //         avatar_id: avatar_id
    //     },
    //     success: function (response){
    //         if(!response.data){
    //             report_error()
    //         }else if(response.data){
    //             $("#profile_img_container img").attr('src', response.data)
    //             remove_modal()
    //         }
    //     }, 
    //     error: function(){
    //         report_error()
    //     }
    // });
}



function reset_msg(){
    $(".uploading_alert_msg").hide()
    $(".uploading_alert_msg").html('Upload')
}





// ********* CLOSE MODAL BUTTON *************//
$(".modal-btn-close").click(function(e){
    e.preventDefault()
    $(".toggle-popup-modal").hide()
})









// $("#upload_profile_banner_btn").click(function(e){
//     e.preventDefault()
//     var banner = $("#banner_preview_image img").attr('src')

//     $("#profile_banner_div").css({
//         backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.274), rgba(0, 0, 0, 0.288)) , url('+banner+')'
//     })

//     remove_modal()
//     $(".toggle-popup-modal").hide()
// })





function remove_modal(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        $("#access_preloader_container").hide()
    }, 1000)
}





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}



// end
})
</script>