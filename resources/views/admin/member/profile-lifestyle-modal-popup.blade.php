
<!-- ABOUT ME START-->
<section class="modal-popup-container modal-form-section" id="lifestyle_modal_popup">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Life style</h4>
                    <p>Edit Lifestyle information</p>
                </div>
                <div class="form-input-popup">
                     <form action="{{ current_url() }}" method="POST">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <div class="alert-form alert_11 text-danger"></div>
                                    <input type="text" id="edit_interest_input" class="form-control" value="{{ $user->interest }}" placeholder="Interest example: cooking, cats, gaming">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_12 text-danger"></div>
                                    <select id="edit_drinking_input" class="selectpicker form-control">
                                        <option value="">Select drinking</option>
                                        @if(count($drinkings))
                                        @foreach($drinkings as $drinking)
                                            <option value="{{ $drinking->title }}" {{  $user->drinking == $drinking->title ? 'selected' : '' }}>{{ ucfirst($drinking->title) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_13 text-danger"></div>
                                    <select id="edit_smoking_input" class="selectpicker form-control">
                                        <option value="">Select smoking</option>
                                        @if(count($smokings))
                                        @foreach($smokings as $smoking)
                                            <option value="{{ $smoking->title }}" {{  $user->smoking == $smoking->title ? 'selected' : '' }}>{{ ucfirst($smoking->title) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <div class="alert-form alert_14 text-danger"></div>
                                    <input type="text" id="edit_language_input" class="form-control" value="{{ $user->language }}" placeholder="Language example: Enlish, Igbo, yoruba">
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="form-group">
                                    <input type="hidden" id="user_id_input" value="{{ $user->id }}">
                                    <button type="button" id="edit_life_style_submit_btn" class="btn-fill-block">Update Detail</button>
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
$("#edit_life_style_submit_btn").click(function(e){
    e.preventDefault()
    life_style()
})



// ******** EDIT LIFE STYLE ************//
function life_style(){
    $(".form_alert_0").html('')
    $(".alert-form").html('')
    var user_id = $("#user_id_input").val()
    var interest = $("#edit_interest_input").val()
    var drinking = $("#edit_drinking_input").val()
    var smoking = $("#edit_smoking_input").val()
    var language = $("#edit_language_input").val()

    $("#edit_life_style_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_lifestyle_field(interest, drinking, smoking, language)){
        $("#edit_life_style_submit_btn").html('Update Detail')
        return
    }


    $.ajax({
        url: "{{ url('/admin/edit-life-style') }}",
        method: "post",
        data: {
            user_id: user_id,
            interest: interest,
            drinking: drinking,
            smoking: smoking,
            language: language,
        },
        success: function (response){
           if(response.error){
                get_lifestyle_error(response.error)
                $("#edit_life_style_submit_btn").html('Update Detail')
           }else if(response.data){
                get_life_style(user_id)
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






function get_lifestyle_error(error){
    $(".alert_11").html(error.interest)
    $(".alert_12").html(error.drinking)
    $(".alert_13").html(error.smoking)
    $(".alert_14").html(error.language)
 
}





function validate_lifestyle_field(interest, drinking, smoking, language){
    var is_state = false;

    if(!interest || !drinking || !smoking || !language){
        is_state = true;
        $(".form_alert_0").html('*All fields is required')
    }else{
        if(interest.length > 150){
            is_state = true;
            $(".alert_11").html('*Maximum of 150 characters')
        }

        if(language.length > 150){
            is_state = true;
            $(".alert_14").html('*Maximum of 150 characters')
        }
    }

    return is_state;
}






// ************ GET LIFE STYLE **************//
function get_life_style(user_id){
    var url = $("#ajax_get_lifestyle_url").attr('href')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-get-lifestyle') }}",
        method: "post",
        data: {
            user_id: user_id
        },
        success: function (response){
            if(response.data){
               location.reload()
            }
            preloader_toggle()
            $("#ul_life_style_body").html(response)
            $("#edit_life_style_submit_btn").html('Update Detail')
        }
    });
}



// ********** REMOVE ACCESS PRELOADER ***********//
function preloader_toggle(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        bottom_alert_success('Profile updated successfully!')
        $("#access_preloader_container").hide()
    }, 1000)
}


// end
})
</script>