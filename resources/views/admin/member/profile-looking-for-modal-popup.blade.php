
<!-- ABOUT ME START-->
<section class="modal-popup-container modal-form-section" id="looking_for_modal_popup">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Looking For</h4>
                    <p>Edit Looking For information</p>
                </div>
                <div class="form-input-popup">
                     <form action="{{ current_url() }}" method="POST">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <div class="alert-form alert_10 text-danger"></div>
                                    <textarea  id="edit_looking_for_detail_input" class="form-control" cols="30" rows="6" placeholder="Describe the kind of person you are looking for...">{{ $user->looking_for_detail ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="form-group">
                                    <input type="hidden" id="looking_user_id_input" value="{{ $user->id }}">
                                    <button type="button" id="edit_looking_for_submit_btn" class="btn-fill-block">Update Detail</button>
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





// ********* LOOKING FOR EDIT ***************//
$("#edit_looking_for_submit_btn").click(function(e){
    e.preventDefault()
    looking_for()
})


// ********* PRESS ENTER TO SUBMIT LOOKING FOR ******//
$("#edit_looking_for_detail_input").on('keypress', function(e){
    if(e.which == 13){
        looking_for()
    }
})



// ******** EDIT ABOUT ME ************//
function looking_for(){
    $(".form_alert_0").html('')
    $(".alert-form").html('')
    var user_id = $("#looking_user_id_input").val()
    var looking_for = $("#edit_looking_for_detail_input").val()

    $("#edit_looking_for_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_lookin_for_field(looking_for)){
        $("#edit_looking_for_submit_btn").html('Update Detail')
        return
    }

    $.ajax({
        url: "{{ url('/admin/edit-looking-for') }}",
        method: "post",
        data: {
            user_id: user_id,
            looking_for_detail: looking_for
        },
        success: function (response){
           if(response.error){
                $(".alert_10").html(response.error.looking_for_detail)
                $("#edit_looking_for_submit_btn").html('Update Detail')
           }else if(response.data){
                preloader_toggle()
                $(".modal-btn-close").click()
                $("#access_preloader_container").show()
                $("#ul_looking_for_body").children().children().html(looking_for)
            }else{
                $("#edit_looking_for_submit_btn").html('Update Detail')
                $(".form_alert_0").html('Network error, try again later!')
            }
        },
        error: function(){
            $("#edit_looking_for_submit_btn").html('Update Detail')
            $(".form_alert_0").html('Network error, try again later!')
        }
    });

}





function validate_lookin_for_field(looking_for){
    var is_state = false;

    if(!looking_for){
        is_state = true;
        $(".alert_10").html('*Looking for fields is required')
    }
    if(looking_for.length < 10){
        is_state = true;
        $(".alert_10").html('*Minimum of 10 characters')
    }
    if(looking_for.length > 1000){
        is_state = true;
        $(".alert_10").html('*Maximum of 1000 characters')
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