
<!-- ABOUT ME START-->
<section class="modal-popup-container modal-form-section" id="physical_info_modal_popup">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Physical Info</h4>
                    <p>Edit Physical Info Information</p>
                </div>
                <div class="form-input-popup">
                     <form action="{{ current_url() }}" method="POST">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_15 text-danger"></div>
                                    <select id="edit_height_input" class="selectpicker form-control">
                                        <option value="">Select height</option>
                                        @if(count($heights))
                                        @foreach($heights as $height)
                                            <option value="{{ $height->height }}" {{  $user->height == $height->height ? 'selected' : '' }}>{{ ucfirst($height->height) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_16 text-danger"></div>
                                    <select id="edit_weight_input" class="selectpicker form-control">
                                        <option value="">Select weight</option>
                                        @if(count($weights))
                                        @foreach($weights as $weight)
                                            <option value="{{ $weight->weight }}" {{  $user->weight == $weight->weight ? 'selected' : '' }}>{{ ucfirst($weight->weight) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_17 text-danger"></div>
                                    <input type="text" id="edit_hair_color_input" class="form-control" value="{{ $user->hair_color }}" placeholder="Hair color">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_18 text-danger"></div>
                                    <input type="text" id="edit_eye_color_input" class="form-control" value="{{ $user->eye_color }}" placeholder="Eye color">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_19 text-danger"></div>
                                    <select id="edit_body_type_input" class="selectpicker form-control">
                                        <option value="">Select body type</option>
                                        @if(count($body_types))
                                        @foreach($body_types as $body_type)
                                            <option value="{{ $body_type->body_type }}" {{  $user->body_type == $body_type->body_type ? 'selected' : '' }}>{{ ucfirst($body_type->body_type) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_20 text-danger"></div>
                                    <select id="edit_ethnicity_input" class="selectpicker form-control">
                                        <option value="">Select ethnicity</option>
                                        @if(count($ethnicities))
                                        @foreach($ethnicities as $ethnicity)
                                            <option value="{{ $ethnicity->ethnicity }}" {{  $user->ethnicity == $ethnicity->ethnicity ? 'selected' : '' }}>{{ ucfirst($ethnicity->ethnicity) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="form-group">
                                    <button type="button" data-url="{{ url('/edit-physical-info') }}" id="edit_physical_info_submit_btn" class="btn-fill-block">Update Detail</button>
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
<a href="{{ url('/ajax-get-physical-info') }}" id="ajax_get_physical_info_url" style="display: none"></a>






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
$("#edit_physical_info_submit_btn").click(function(e){
    e.preventDefault()
    life_style()
})



// ******** EDIT LIFE STYLE ************//
function life_style(){
    $(".form_alert_0").html('')
    $(".alert-form").html('')
    var url = $("#edit_physical_info_submit_btn").attr('data-url')
    var height = $("#edit_height_input").val()
    var weight = $("#edit_weight_input").val()
    var hair_color = $("#edit_hair_color_input").val()
    var eye_color = $("#edit_eye_color_input").val()
    var body_type = $("#edit_body_type_input").val()
    var ethnicity = $("#edit_ethnicity_input").val()

    $("#edit_physical_info_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_physical_info_field(height, weight, hair_color, eye_color, body_type, ethnicity)){
        $("#edit_physical_info_submit_btn").html('Update Detail')
        return
    }


    $.ajax({
        url: url,
        method: "post",
        data: {
            height: height,
            weight: weight,
            hair_color: hair_color,
            eye_color: eye_color,
            body_type: body_type,
            ethnicity: ethnicity,
        },
        success: function (response){
           if(response.error){
                get_physical_error(response.error)
                $("#edit_physical_info_submit_btn").html('Update Detail')
           }else if(response.data){
                get_physical_info()
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






function get_physical_error(error){
    $(".alert_15").html(error.height)
    $(".alert_16").html(error.weight)
    $(".alert_17").html(error.hair_color)
    $(".alert_18").html(error.eye_color)
    $(".alert_19").html(error.body_type)
    $(".alert_20").html(error.ethnicity)
 
}





function validate_physical_info_field(height, weight, hair_color, eye_color, body_type, ethnicity){
    var is_state = false;

    if(!height || !weight || !hair_color || !eye_color || !body_type || !ethnicity){
        is_state = true;
        $(".form_alert_0").html('*All fields is required')
    }else{
        if(hair_color.length > 50){
            is_state = true;
            $(".alert_17").html('*Maximum of 50 characters')
        }

        if(eye_color.length > 50){
            is_state = true;
            $(".alert_18").html('*Maximum of 50 characters')
        }
    }

    return is_state;
}






// GET LIFE STYLE
function get_physical_info(){
    var url = $("#ajax_get_physical_info_url").attr('href')

    csrf_token() //csrf token

    $.ajax({
        url: url,
        method: "post",
        data: {
            get_physical_info: 'get_physical_info'
        },
        success: function (response){
            if(response.data){
               location.reload()
            }
            preloader_toggle()
            $("#ul_phisical_info_body").html(response)
            $("#edit_physical_info_submit_btn").html('Update Detail')
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