
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
                                        <option value="yes" {{  $user->HIV == 'YES' ? 'selected' : '' }}>Positive</option>
                                        <option value="no" {{  $user->HIV == 'NO' ? 'selected' : '' }}>Negetaive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_5 text-danger"></div>
                                    <select id="edit_religion_input"class="selectpicker form-control">
                                        <option value="">Select religion</option>
                                        <option value="christain" {{  $user->religion == 'christain' ? 'selected' : '' }}>Christian</option>
                                        <option value="muslim" {{  $user->religion == 'muslim' ? 'selected' : '' }}>Muslim</option>
                                        <option value="other" {{  $user->religion == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_complexion text-danger"></div>
                                    <input type="text" id="edit_complexion_input" class="form-control" value="{{ $user->complexion }}" placeholder="Complexion">
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_phone_number text-danger"></div>
                                    <input type="text" id="edit_phone_number_input" class="form-control" value="{{ $user->phone }}" placeholder="Phone number">
                                </div>
                            </div>
                             <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <div class="alert-form alert_education text-danger"></div>
                                    <input type="text" id="edit_education_input" class="form-control" value="{{ $user->education }}" placeholder="University">
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_career text-danger"></div>
                                    <input type="text" id="edit_career_input" class="form-control" value="{{ $user->career }}" placeholder="Career">
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_birthdate text-danger"></div>
                                    <input type="date" id="edit_birthdate_input" class="form-control" value="{{ date('Y-m-d', strtotime($user->birth_date))}}" placeholder="Birth date">
                                </div>
                            </div>
                             <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_kids text-danger"></div>
                                    <input type="number" min="0" id="edit_children_input" class="form-control" value="{{ $user->children }}" placeholder="Number of kids">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_7 text-danger"></div>
                                    <input type="text" id="edit_location_input" class="form-control" value="{{ $user->location }}" placeholder="Location">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_state_of_origin text-danger"></div>
                                    <input type="text" id="edit_state_of_origin_input" class="form-control" value="{{ $user->state_of_origin }}" placeholder="State of origin">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="alert-form alert_country text-danger"></div>
                                    <input type="text" id="edit_country_input" class="form-control" value="{{ $user->country }}" placeholder="Enter country">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <input type="hidden" id="user_id_input" value="{{ $user->id }}">
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
    var user_id = $("#user_id_input").val()
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
    var phone = $("#edit_phone_number_input").val()
    var country = $("#edit_country_input").val()
    var children = $("#edit_children_input").val()
    var birth_date = $("#edit_birthdate_input").val()
    var state_of_origin = $("#edit_state_of_origin_input").val()
   

    $("#edit_detail_info_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    if(validate_detail_field(country, phone, state_of_origin, hiv, complexion, education, career, genotype, display_name, i_am, looking_for, marital_status, age, religion, location)){
        $("#edit_detail_info_submit_btn").html('Update Detail')
        return;
    }
    
    $.ajax({
        url: "{{ url('/admin/edit-detail-info') }}",
        method: "post",
        data: {
            age: age,
            i_am: i_am,
            hiv: hiv,
            phone: phone,
            career: career,
            user_id: user_id,
            country: country,
            genotype: genotype,
            location: location,
            religion: religion,
            children: children,
            university: education,
            birth_date: birth_date,
            complexion: complexion,
            looking_for: looking_for,
            display_name: display_name,
            marital_status: marital_status,
            state_of_origin: state_of_origin
        },
        success: function (response){
            if(response.error){
                get_detail_error(response.error)
                $("#edit_detail_info_submit_btn").html('Update Detail')
            }else if(response.data){
                get_ajax_edit_detail(user_id)
                $(".modal-btn-close").click()
                $("#access_preloader_container").show()
            }else{
                $("#edit_detail_info_submit_btn").html('Update Detail')
                $(".form_alert_0").html('Network error, try again later!')
            }
        },
        error: function(){
            $("#edit_detail_info_submit_btn").html('Update Detail')
            $(".form_alert_0").html('Network error, try again later!')
        }
    });
    
}




// *********** GET DETAIL INFO *************//
function get_ajax_edit_detail(user_id){
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-get-detail-info') }}",
        method: "post",
        data: {
            user_id: user_id
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




function validate_detail_field(country, phone, state_of_origin, hiv, complexion, education, career, genotype, display_name, i_am, looking_for, marital_status, age, religion, location){
    var is_state = false;
    if(display_name.length > 50){
        is_state = true;
        $(".alert_0").html('*Maximum of 50 characters')
    }
    if(complexion.length > 50){
        is_state = true;
        $(".alert_complexion").html('*Maximum of 50 characters')
    }
    if(education.length > 100){
        is_state = true;
        $(".alert_education").html('*Maximum of 100 characters')
    }
    if(career.length > 100){
        is_state = true;
        $(".alert_career").html('*Maximum of 100 characters')
    }
    if(phone != ''){
        if(phone.length < 11){
            is_state = true;
            $(".alert_phone_number").html('*Minimum of 11 characters')
        }
        if(phone.length > 20){
            is_state = true;
            $(".alert_phone_number").html('*Maximum of 20 characters')
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
    $(".alert_education").html(error.university)
    $(".alert_career").html(error.career)
    $(".alert_phone_number").html(error.phone)
    $(".alert_country").html(error.country)
    $(".alert_state_of_origin").html(error.state_of_origin)
}





// ********** REMOVE ACCESS PRELOADER ***********//
function preloader_toggle(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        bottom_alert_success('Profile updated successfully!')
        $("#access_preloader_container").hide()
    }, 1000)
}































// function validate_detail_field(phone, state_of_origin, hiv, complexion, education, career, genotype, display_name, i_am, looking_for, marital_status, age, religion, location){
//     var is_state = false;

//     if(!phone || !state_of_origin || !complexion || !hiv || !education || !career || !genotype || !display_name || !looking_for || !i_am || !marital_status || !age || !religion || !location){
//         is_state = true;
//         $(".form_alert_0").html('*All fields is required')
//     }else{
//         if(display_name.length > 50){
//             is_state = true;
//             $(".alert_0").html('*Maximum of 50 characters')
//         }
//         if(complexion.length > 50){
    // is_state = true;
//             $(".alert_complexion").html('*Maximum of 50 characters')
//         }
//         if(education.length > 100){
    // is_state = true;
//             $(".alert_education").html('*Maximum of 100 characters')
//         }
//         if(career.length > 100){
    // is_state = true;
//             $(".alert_career").html('*Maximum of 100 characters')
//         }
//         if(phone.length < 11){
    // is_state = true;
//             $(".alert_phone_number").html('*Minimum of 11 characters')
//         }
//         if(phone.length > 11){
                // is_state = true;
//             $(".alert_phone_number").html('*Maximum of 11 characters')
//         }
//     }
//     return is_state;
// }











// end
})
</script>



