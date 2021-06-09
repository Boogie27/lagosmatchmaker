
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
                                    <button type="button" data-url="{{ url('/edit-about-me') }}" id="edit_about_submit_btn" class="btn-fill-block">Update Detail</button>
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
<a href="{{ url('/ajax-get-about-me') }}" id="ajax_get_about_me_url" style="display: none"></a>






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
    var url = $("#edit_about_submit_btn").attr('data-url')
    var about = $("#edit_about_me_input").val()

    $("#edit_about_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_about_field(about)){
        $("#edit_about_submit_btn").html('Update Detail')
        return
    }

    $.ajax({
        url: url,
        method: "post",
        data: {
            about: about
        },
        success: function (response){
           if(response.error){
                $(".alert_9").html(response.error.about)
                $("#edit_about_submit_btn").html('Update Detail')
           }else if(response.data){
                get_about_me()
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





function get_about_me(){
    var url = $("#ajax_get_about_me_url").attr('href')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            get_about_me: 'get_about_me'
        },
        success: function (response){
            if(response.data){
                location.reload()
            }
            preloader_toggle()
            $("#ul_about_me_body").html(response)
            $("#edit_about_submit_btn").html('Update Detail')
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