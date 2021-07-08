


<!-- EDIT DETAIL INFO START-->
<section class="modal-popup-container modal-form-section" id="edit_detail_info_section">
    <div class="edit-info-main">
        <div class="edit-info-dark-theme dark-theme-modal-popup">
            <div class="edit-info-container">
                <div class="btn-close-container">
                    <button class="modal-btn-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="title-header">
                    <h4>Detail Info</h4>
                    <p>Edit your basic detail information</p>
                </div>
                <div class="form-input-popup">
                     <form action="{{ current_url() }}" method="POST">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_0 text-danger"></div>
                                    <input type="text" id="edit_display_name_input" class="form-control" value="{{ $display_name }}" placeholder="Display name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_1 text-danger"></div>
                                    <select id="edit_im_am_input" class="selectpicker form-control">
                                        <option value="">I am</option>
                                        <option value="male" {{  $gender == 'man' ? 'selected' : '' }}>Man</option>
                                        <option value="female" {{  $gender == 'woman' ? 'selected' : '' }}>Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <div class="alert-form alert_2 text-danger"></div>
                                    <select id="edit_looking_for_input" class="selectpicker form-control">
                                        <option value="">Looking For</option>
                                        <option value="man" {{  $user->looking_for == 'man' ? 'selected' : '' }}>Man</option>
                                        <option value="woman" {{  $user->looking_for == 'woman' ? 'selected' : '' }}>Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <div class="alert-form alert_3 text-danger"></div>
                                    <select id="edit_marital_status_input" class="selectpicker form-control">
                                        <option value="">Marital Status</option>
                                        @if(count($marital_status))
                                            @foreach($marital_status as $marital_stat)
                                            <option value="{{ $marital_stat->marital_status }}" {{  $marital_stat->marital_status == $user->marital_status ? 'selected' : '' }}>{{ $marital_stat->marital_status }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="form-group">
                                    <div class="alert-form alert_4 text-danger"></div>
                                    <input type="number" min="1" id="edit_age_input" class="form-control" value="{{ $user->age }}" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_21 text-danger"></div>
                                    <select id="edit_genotype_input" class="selectpicker form-control">
                                        <option value="">Select genotype</option>
                                        @if(count($genotypes))
                                        @foreach($genotypes as $genotype)
                                            <option value="{{ $genotype->genotype }}" {{  $user->genotype == $genotype->genotype ? 'selected' : '' }}>{{ ucfirst($genotype->genotype) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_hiv text-danger"></div>
                                    <select id="edit_HIV_input" class="selectpicker form-control">
                                        <option value="">Select HIV status</option>
                                        <option value="yes" {{  $user->HIV == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="no" {{  $user->HIV == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_5 text-danger"></div>
                                    <select id="edit_religion_input"class="selectpicker form-control">
                                        <option value="">Religion</option>
                                        <option value="christian" {{  $user->religion == 'christian' ? 'selected' : '' }}>Christian</option>
                                        <option value="muslim" {{  $user->religion == 'muslim' ? 'selected' : '' }}>Muslim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="alert-form alert_complexion text-danger"></div>
                                    <input type="text" id="edit_complexion_input" class="form-control" value="{{ $user->complexion }}" placeholder="Complexion">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="alert-form alert_education text-danger"></div>
                                    <input type="text" id="edit_education_input" class="form-control" value="{{ $user->education }}" placeholder="Education">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="alert-form alert_career text-danger"></div>
                                    <input type="text" id="edit_career_input" class="form-control" value="{{ $user->career }}" placeholder="Career">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="alert-form alert_7 text-danger"></div>
                                    <select id="edit_location_input" class="selectpicker form-control">
                                        <option value="">Select location</option>
                                        @if(count($states))
                                        @foreach($states as $state)
                                            <option value="{{ $state->state }}" {{   $state->state == strtoupper($user->location) ? 'selected' : '' }}>{{ strtoupper($state->state) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="form-group">
                                    <button type="button" id="edit_detail_info_submit_btn" class="btn-fill-block">Update Detail</button>
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
<!-- EDIT DETAIL INFO END-->











<!-- AJAX URLS -->






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






// ********* DETAIL INFO EDIT ***************//
$("#edit_detail_info_submit_btn").click(function(e){
    e.preventDefault()
    edit_detail_info()
})





function edit_detail_info(){
    $(".form_alert_0").html('')
    $(".alert-form").html('')
    var display_name = $("#edit_display_name_input").val()
    var i_am = $("#edit_im_am_input").val()
    var looking_for = $("#edit_looking_for_input").val()
    var marital_status = $("#edit_marital_status_input").val()
    var age = $("#edit_age_input").val()
    var religion = $("#edit_religion_input").val()
    var location = $("#edit_location_input").val()
    var genotype = $("#edit_genotype_input").val()
    var hiv = $("#edit_HIV_input").val()
    var complexion = $("#edit_complexion_input").val()
    var education = $("#edit_education_input").val()
    var career = $("#edit_career_input").val()
   

    $("#edit_detail_info_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_detail_field(hiv, complexion, education, career, genotype, display_name, i_am, looking_for, marital_status, age, religion, location)){
        $("#edit_detail_info_submit_btn").html('Update Detail')
        return;
    }
    
    $.ajax({
        url: "{{ url('/edit-detail-info') }}",
        method: "post",
        data: {
            age: age,
            i_am: i_am,
            hiv: hiv,
            career: career,
            genotype: genotype,
            location: location,
            religion: religion,
            education: education,
            complexion: complexion,
            looking_for: looking_for,
            display_name: display_name,
            marital_status: marital_status
        },
        success: function (response){
            if(response.error){
                get_detail_error(response.error)
                $("#edit_detail_info_submit_btn").html('Update Detail')
            }else if(response.data){
                get_ajax_edit_detail()
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




// *********** GET DETAIL INFO *************//
function get_ajax_edit_detail(){
    // var url = $("#ajax_get_detail_info_url").attr('href')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-detail-info') }}",
        method: "post",
        data: {
            get_detail_info: 'get_detail_info'
        },
        success: function (response){
            if(response.data){
                location.reload()
            }
            preloader_toggle()
            $("#ul_profile_detail_body").html(response)
            $("#edit_detail_info_submit_btn").html('Update Detail')
        }
    });
}




function validate_detail_field(hiv, complexion, education, career, genotype, display_name, i_am, looking_for, marital_status, age, religion, location){
    var is_state = false;

    if(!complexion || !hiv || !education || !career || !genotype || !display_name || !looking_for || !i_am || !marital_status || !age || !religion || !location){
        is_state = true;
        $(".form_alert_0").html('*All fields are required')
    }else{
        if(display_name.length > 50){
            is_state = true;
            $(".alert_0").html('*Maximum of 50 characters')
        }
        if(complexion.length > 50){
            $(".alert_complexion").html('*Maximum of 50 characters')
        }
        if(education.length > 100){
            $(".alert_education").html('*Maximum of 100 characters')
        }
        if(career.length > 100){
            $(".alert_career").html('*Maximum of 100 characters')
        }
    }
    return is_state;
}





function get_detail_error(error){
    $(".alert_0").html(error.display_name)
    $(".alert_1").html(error.i_am)
    $(".alert_2").html(error.looking_for)
    $(".alert_3").html(error.marital_status)
    $(".alert_4").html(error.age)
    $(".alert_5").html(error.religion)
    $(".alert_7").html(error.location)
    $(".alert_21").html(error.genotype)
    $(".alert_hiv").html(error.hiv)
    $(".alert_complexion").html(error.complexion)
    $(".alert_education").html(error.education)
    $(".alert_career").html(error.career)
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



