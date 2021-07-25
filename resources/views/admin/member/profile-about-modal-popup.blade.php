
<!-- ABOUT ME START-->
<section class="modal-popup-container modal-form-section" id="about_me_edit_btn_modal">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>About me</h4>
                    <p>Edit about me information</p>
                </div>
                <div class="form-input-popup">
                     <form action="{{ current_url() }}" method="POST">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <div class="alert-form alert_9 text-danger"></div>
                                    <textarea  id="edit_about_me_input" class="form-control" cols="30" rows="6" placeholder="Writing something nice about your self...">{{ $user->about ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="form-group">
                                    <input type="hidden" id="about_user_id_input" value="{{ $user->id }}">
                                    <button type="button"  id="edit_about_submit_btn" class="btn-fill-block">Update Detail</button>
                                    <div class="form-error-alert form_alert_0 text-danger"></div>
                                </div>
                            </div>
                        </div>
                     </form>
                </div>
            <div>
        <div>
    <div>
</section>
<!-- ABOUT ME END-->

















<script>
$(document).ready(function(){

// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}





// ********* ABOUT ME EDIT ***************//
$("#edit_about_submit_btn").click(function(e){
    e.preventDefault()
    edit_about_me()
})


// ********* PRESS ENTER TO SUBMIT ABOUT ******//
$("#edit_about_me_input").on('keypress', function(e){
    if(e.which == 13){
        edit_about_me()
    }
})



// ******** EDIT ABOUT ME ************//
function edit_about_me(){
    $(".form_alert_0").html('')
    $(".alert-form").html('')
    var user_id = $("#about_user_id_input").val()
    var about = $("#edit_about_me_input").val()

    $("#edit_about_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_about_field(about)){
        $("#edit_about_submit_btn").html('Update Detail')
        return
    }

    $.ajax({
        url: "{{ url('/admin/edit-about-me') }}",
        method: "post",
        data: {
            about: about,
            user_id: user_id
        },
        success: function (response){
           if(response.error){
                $(".alert_9").html(response.error.about)
                $("#edit_about_submit_btn").html('Update Detail')
           }else if(response.data){
                preloader_toggle()
                $(".modal-btn-close").click()
                $("#ul_about_me_body").children().children().html(about)
            }else{
                $("#edit_about_submit_btn").html('Update Detail')
                $(".form_alert_0").html('Network error, try again later!')
            }
        },
        error: function(){
            $("#edit_about_submit_btn").html('Update Detail')
            $(".form_alert_0").html('Network error, try again later!')
        }
    });

}





function validate_about_field(about){
    var is_state = false;

    if(!about){
        is_state = true;
        $(".alert_9").html('*About fields is required')
    }
    if(about.length < 20){
        is_state = true;
        $(".alert_9").html('*Minimum of 20 characters')
    }
    if(about.length > 1000){
        is_state = true;
        $(".alert_9").html('*Maximum of 1000 characters')
    }

    return is_state;
}






// ********** REMOVE ACCESS PRELOADER ***********//
function preloader_toggle(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        $("#access_preloader_container").hide()
        bottom_alert_success('Profile updated successfully!')
    }, 1000)
}


// end
})
</script>