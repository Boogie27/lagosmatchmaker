
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
                                    <button type="button" data-url="{{ url('/edit-looking-for') }}" id="edit_looking_for_submit_btn" class="btn-fill-block">Update Detail</button>
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






<!-- AJAX URLS -->
<a href="{{ url('/ajax-get-looking-for') }}" id="ajax_get_looking_for_url" style="display: none"></a>






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
    var url = $("#edit_looking_for_submit_btn").attr('data-url')
    var looking_for = $("#edit_looking_for_detail_input").val()

    $("#edit_looking_for_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_lookin_for_field(looking_for)){
        $("#edit_looking_for_submit_btn").html('Update Detail')
        return
    }


    $.ajax({
        url: url,
        method: "post",
        data: {
            looking_for_detail: looking_for
        },
        success: function (response){
           if(response.error){
                $(".alert_10").html(response.error.looking_for)
                $("#edit_looking_for_submit_btn").html('Update Detail')
           }else if(response.data){
                get_looking_for()
                $(".modal-btn-close").click()
                $("#access_preloader_container").show()
            }else{
                $(".form_alert_0").html('Network error, try again later!')
            }
        },
        error: function(){
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





function get_looking_for(){
    var url = $("#ajax_get_looking_for_url").attr('href')

      csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            get_looking_for: 'get_looking_for'
        },
        success: function (response){
            if(response.data){
                location.reload()
            }
            preloader_toggle()
            $("#ul_looking_for_body").html(response)
            $("#edit_looking_for_submit_btn").html('Update Detail')
        }
    });
}





// ********** REMOVE ACCESS PRELOADER ***********//
function preloader_toggle(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        $("#access_preloader_container").hide()
    }, 1000)
}


// end
})
</script>