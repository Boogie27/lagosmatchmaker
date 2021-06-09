
<!-- AVATAR MODAL POPUP START -->
<section class="avatar-popup-modal modal-popup-container" id="avatar_popup_section">
    <div class="avatar-modal-container">
        <div class="avatar-modal-dark-theme">
            <div class="avatar-inner-content">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Display Image</h4>
                    <p>Select your prefered display image</p>
                    <p id="uploading_alert_msg"></p>
                </div>
                <div class="avatar-body-container" id="avatar_body_container">
                    <!-- avatar insert here using ajax -->
                </div>
                <div class="avatar-btn">
                    <a href="#" id="avatar_modal_close">Cancle</a>
                    <a href="{{ url('/upload-profile-image') }}" id="upload_profile_img_submit" class="accept">Upload</a>
                    <input type="hidden" id="avatar_id_input" value="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- AVATAR MODAL POPUP END -->










<!-- ************ SCRIPT ***************** -->
<script>
$(document).ready(function(){
// ******* CLICK TO PICK AVATAR ********//
$(".avatar-body-container").on('click', '.avatar-img a', function(e){
    e.preventDefault()
    $("#avatar_id_input").val($(this).attr('id'))
    var image_src = $(this).children('img').attr('src')
    $("#vatar_img_preview").children('img').attr('src', image_src)
})




// ********* AVATAR MODAL CLOSE *************//
$("#avatar_modal_close").click(function(e){
    e.preventDefault()
    $("#avatar_popup_section").hide()
})




// ********** UPLOAD PROFILE IMAGE **********//
$("#upload_profile_img_submit").click(function(e){
    e.preventDefault()
    var avatar_id = $("#avatar_id_input").val()

    if(avatar_id == ''){
        $("#uploading_alert_msg").html('')
        $("#avatar_popup_section").hide()
        return
    }
    update_profile_image()
})


// ********** UPLOAD PROFILE IMAGE **********//
function update_profile_image(){
    var url = $('#upload_profile_img_submit').attr('href')
    var avatar_id = $("#avatar_id_input").val()
   
    $("#uploading_alert_msg").addClass('text-success')
    $("#uploading_alert_msg").removeClass('text-danger')
    $("#uploading_alert_msg").html('Uploading, please wait...')

    csrf_token() //csrf token  

    $.ajax({
        url: url,
        method: "post",
        data: {
            avatar_id: avatar_id
        },
        success: function (response){
            if(!response.data){
                report_error()
            }else if(response.data){
                $("#profile_img_container img").attr('src', response.data)
                remove_modal()
            }
        }, 
        error: function(){
            report_error()
        }
    });
}




function remove_modal(){
    setTimeout(function(){
        $("#uploading_alert_msg").html('')
        $("#avatar_popup_section").hide()
    }, 1000)
}





// report error
function report_error(){
    $("#uploading_alert_msg").removeClass('text-success')
    $("#uploading_alert_msg").addClass('text-danger')
    $("#uploading_alert_msg").html('*Network error, try again later!')
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