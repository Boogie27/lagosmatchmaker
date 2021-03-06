


<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid"><!-- Start Content-->
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ ucfirst($user->membership_level) }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($user->user_name) }}</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">{{ ucfirst($display_name) }} Detail</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
               
                <!-- PROFILE DETAILS START-->
                <div class="profile-detail-section">
                    <div class="text-right pb-3">
                        <div class="drop-down">
                            <i class="fa fa-ellipsis-h drop-down-open"></i>
                            <ul class="drop-down-body">
                                <li class="text-left">
                                    <a href="{{ url('/admin/friends/'.$user->id) }}" class="">Match</a>
                                    <a href="mailto:{{ $user->email }}" class="">Send mail</a>
                                    @if(!$user->is_approved)
                                    <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->id }}" class="deatil-approve-confirm-box-open">Approve</a>
                                    @endif
                                    <a href="{{ url('/admin/subscription-history/'.$user->id) }}" class="">subscription details</a>
                                    @if($user->is_approved && !$user->is_deactivated)
                                    <a href="#" id="{{ $user->id }}" class="add-user-subscription-btn">Add subscription</a>
                                    @endif
                                    <a href="{{ url('/admin/blocked-members/'.$user->id) }}" class="">Blocked members</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="profile-detail-container">
                        <div class="row">

                            <div class="col-xl-12"><!-- profile detail left end-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Profile Image</h4>
                                        <div class="user-delete-img">
                                        <a href="#" class="profile-image-iconx" title="Add profile image"><i class="fa fa-camera"></i></a>
                                            <a href="#" id="open_profile_image_delete" class="text-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <input type="file" id="profile_image_input" style="display: none;">
                                    </div>
                                    <ul class="ul-profile-detail">
                                        <li class="user-profile-img">
                                            @php($user_image = $user->avatar ? $user->avatar : avatar($user->gender))
                                            <img src="{{ asset($user_image) }}" alt="">
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Detail info</h4> 
                                        <a href="#" id="detail_info_edit_btn_open"><i class="fa fa-pen"></i></a>
                                    </div>
                                    <ul class="ul-profile-detail" id="ul_profile_detail_body">
                                        <li>
                                            <div class="title">Name  </div>
                                            <div class="body">: {{ ucfirst($display_name) }}</div>
                                        </li>
                                        <li>
                                            <div class="title">I am  </div>
                                            <div class="body">: {{ $gender ? ucfirst($gender) : 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Looking for  </div>
                                            <div class="body">: {{ $user->looking_for ? ucfirst($user->looking_for) : 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Marital Status  </div>
                                            <div class="body">: {{ $user->marital_status ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Age  </div>
                                            <div class="body">: {{ $user->age ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Birth date  </div>
                                            <div class="body">: {{ $user->birth_date ? date('d M Y', strtotime($user->birth_date)) : 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Genotype  </div>
                                            <div class="body">: {{ $user->genotype ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Number of children  </div>
                                            <div class="body">: {{ $user->children ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">HIV Status  </div>
                                            @if($user->HIV == 'YES')
                                            <div class="body">: Positive</div>
                                            @endif
                                            @if($user->HIV == 'NO')
                                            <div class="body">: Negative</div>
                                            @endif
                                            @if(!$user->HIV)
                                            <div class="body">: Empty</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Phone number  </div>
                                            <div class="body">: {{ $user->phone ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Complexion  </div>
                                            <div class="body">: {{ $user->complexion ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">University  </div>
                                            <div class="body">: {{ $user->education ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Career  </div>
                                            <div class="body">: {{ $user->career ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Religion  </div>
                                            <div class="body">: {{ $user->religion ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">State Of Origin  </div>
                                            <div class="body">: {{ $user->state_of_origin ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Location  </div>
                                            <div class="body">: {{ $user->location ? ucfirst($user->location) : 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Country  </div>
                                            <div class="body">: {{ $user->country ? ucfirst($user->country) : 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Membership level  </div>
                                            <div class="body">: {{ $user->membership_level ?? 'Empty' }}</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>About me</h4>
                                        <a href="#" id="about_me_edit_btn_open"><i class="fa fa-pen"></i></a>
                                    </div>
                                    <ul class="ul-profile-detail" id="ul_about_me_body">
                                        <li>
                                            <p class="detail-about-p">{{ $user->about ?? 'Empty' }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Lifestyle</h4>
                                       
                                        <a href="#" id="detail_lifestyle_btn_open"><i class="fa fa-pen"></i></a>
                                    </div>
                                    <ul class="ul-profile-detail" id="ul_life_style_body">
                                        <li>
                                            <div class="title">Interest  </div>
                                            <div class="body">: {{ $user->interest ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Smoking  </div>
                                            <div class="body">: {{ $user->smoking ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Drinking  </div>
                                            <div class="body">: {{ $user->drinking ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Language  </div>
                                            <div class="body">: {{ $user->language ?? 'Empty' }}</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ADMIN MEMBER DETAIL PHYSICAL-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Physical info</h4>
                                        
                                        <a href="#" id="detail_physical_info_btn_open"><i class="fa fa-pen"></i></a>
                                    </div>
                                    <ul class="ul-profile-detail" id="ul_phisical_info_body">
                                        <li>
                                            <div class="title">Height  </div>
                                            <div class="body">: {{ $user->height  ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Weight  </div>
                                            <div class="body">: {{ $user->weight ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Body type  </div>
                                            <div class="body">: {{ $user->body_type ?? 'Empty' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Ethnicity  </div>
                                            <div class="body">: {{ $user->ethnicity ?? 'Empty' }}</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="profile-detail-left" id="profile_id_card_content">
                                    <div class="title-header">
                                        <h4>Other details</h4>
                                        <a href="#" id="edit_id_card_btn_open"><i class="fa fa-pen"></i></a>
                                        @if($user->id_card)
                                        <a href="#" class="text-danger delete-id-card-btn-open"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </div>
                                    <ul class="ul-profile-detail" id="ul_id_card_body">
                                        <li>
                                            <div class="title">Member ID CARD  </div>
                                            @if($user->id_card)
                                            <div class="body"> <a href="#" data-url="{{ asset($user->id_card) }}" id="id_card_open_btn" class="mini-btn">View ID card</a></div>
                                            @else
                                            <div class="body">: None</div>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- profile detail left end-->
                        </div>
                    </div>
                </div>
                <!-- PROFILE DETAILS END-->
            </div><!-- end Content-->
        </div>
    </div>
</section>







<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="id_card_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="id-card-main-container">
                    <div class="confirm-header">
                        <p><b>{{ ucfirst($user->user_name)}} ID CARD</b></p>
                        <div class="member-id-card" id="member_id_card">
                            <img src="" alt="">
                        </div>
                    </div>
                </div>
                <div class="confirm-form text-right p-2">
                    <a href="#" class="text-danger delete-id-card-btn-open-modal">delete</a>
                    <a href="{{ asset($user->id_card) }}" class="download-id-card-btn mini-btn" download><i class="fa fa-arrow-down"></i> Download</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->









<!-- ID CAR MODAL START -->
<section class="modal-alert-popup" id="ID_card_modal_popup">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <h4 style="color: #555;">Upload ID Card</h4>
                    <p>Upload Government issued or valid ID card, 1MB max</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="file" id="id_card_input" style="display: none;">
                        <div class="alert-form alert_0 text-danger"></div>
                        <div class="form-group">
                            <button type="button" id="ID_card_input_open_btn" class="confirm-btn">Upload Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ID CAR MODAL END -->








<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="member_approve_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to approve <b>{{ $user->user_name }}</b>?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="member_approve_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->









<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_id_card_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete {{ $user->user_name }} <b>ID card</b>?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_id_card_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->










<!--  DELETE PROFILE IMAGE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_user_profile_img_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this profile image?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="delete_user_profile_img_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE PROFILE IMAGE MODAL ALERT END -->









<!--  PROFILE MODAL START -->
<section class="modal-alert-popup" id="cropper_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content cropper">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p><b>Crop image</b></p>
                </div>
                <div class="cropper-form">
                    <img src="{{ asset('web/images/avatar/male.png') }}" alt="" id="cropper_sample_img">
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="cropper_confirm_submit_btn" class="confirm-btn">Upload image</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  PROFILE MODAL ALERT END -->






@include('admin.member.member-detail-modal-popup')
@include('admin.member.profile-about-modal-popup')
@include('admin.member.profile-looking-for-modal-popup')
@include('admin.member.profile-lifestyle-modal-popup')
@include('admin.member.profile-physical-info-modal-popup')







































<script>
$(document).ready(function(){
// ************ OPEN DETAIL MODAL *********//
$("#detail_info_edit_btn_open").click(function(e){
    e.preventDefault();
    $("#edit_detail_info_section").show()
})





// ************ OPEN ABOUT MODAL *********//
$("#about_me_edit_btn_open").click(function(e){
    e.preventDefault();
    $("#about_me_edit_btn_modal").show()
})




// ************ OPEN LOOKING FOR MODAL *********//
$("#looking_for_btn_open").click(function(e){
    e.preventDefault();
    $("#looking_for_modal_popup").show()
})





// ************ OPEN LIFESTYLE MODAL *********//
$("#detail_lifestyle_btn_open").click(function(e){
    e.preventDefault();
    $("#lifestyle_modal_popup").show()
})





// ************ OPEN PHYSICAL MODAL *********//
$("#detail_physical_info_btn_open").click(function(e){
    e.preventDefault();
    $("#physical_info_modal_popup").show()
})




// ************ VIEW ID CARD MODAL *********//
var state = false;
var id_card
$("#profile_id_card_content").on('click', '#id_card_open_btn', function(e){
    e.preventDefault();
    id_card = $(this).attr('data-url')

    if(state == false){
        state = true;
        return get_id_card()
    }

    $('.download-id-card-btn').attr('href', id_card)
    $(".member-id-card").children('img').attr('src', id_card)
    $("#id_card_modal_popup_box").show()
})



function get_id_card(){
    $("#access_preloader_container").show()
    setTimeout(function(){
        $("#access_preloader_container").hide()
        $('.download-id-card-btn').attr('href', id_card)
        $(".member-id-card").children('img').attr('src', id_card)
        $("#id_card_modal_popup_box").show()
    }, 1000)
}








// *********** APPROVE USER MODAL OPEN **************//
var user_id
var self
$(".deatil-approve-confirm-box-open").click(function(e){
    e.preventDefault()
    self = $(this)
    user_id = $(this).attr('id')
    name = $(this).attr('data-name')

    $("#member_approve_modal_popup_box").show()
})



// ********** APPOVE USER ***************//
$("#member_approve_confirm_submit_btn").click(function(e){
    e.preventDefault()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-approve-member') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data){
                $(self).remove()
                bottom_alert_success('User has been approved!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });

})







// ********* OPEN ID CARD MODAL POPUP *********//
$("#profile_id_card_content").on('click', '#edit_id_card_btn_open', function(e){
    e.preventDefault()
    $("#ID_card_modal_popup").show()
})



// ********* ID CARD INPUT OPEN *********//
$("#ID_card_input_open_btn").click(function(e){
    e.preventDefault()
    $("#id_card_input").val('')
    $("#id_card_input").click()
})






// ********* UPLOAD ID CARD *********//
$("#id_card_input").on('change', function(e){
    var user_id = "{{ $user->id }}"
    var image = e.target.files
    var extension = image[0].type;
    $("#ID_card_input_open_btn").html('Please wait...')
    
    if(extension != 'image/jpeg'){
        $("#ID_card_modal_popup").hide()
        return bottom_alert_error('Image type must be jpg, jpeg, png!')
    }


    var data = new FormData();
    var image = $(image)[0];

    data.append('image', image);
    data.append('user_id', user_id);

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/upload-id-card-edit') }}",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
            if(response.error){
                $("#ID_card_input_open_btn").html('Upload Now')
                return $(".alert_0").html(response.error.image)
            }else if(response.id_upload){
                $('.download-id-card-btn').attr('href', response.id_upload)
                $("#profile_id_card_content").html(response.content)
                bottom_alert_success('ID card uploaded successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#id_card_input").val('')
            $("#ID_card_modal_popup").hide()
            $("#ID_card_input_open_btn").html('Upload Now')
        },
        error: function(){
            $(".modal-alert-popup").hide()
            $("#ID_card_input_open_btn").html('Upload Now')
            bottom_alert_error('Network error, try again later!')
        }
    });
})






// ******** DELETE ID CARD MODAL OPEN ************//
$("#profile_id_card_content").on('click', '.delete-id-card-btn-open', function(e){
    e.preventDefault()
    $("#delete_id_card_modal_popup_box").show()
})

$(".delete-id-card-btn-open-modal").click(function(e){
    e.preventDefault()
    $("#delete_id_card_modal_popup_box").show()
})






// ******** DELETE ID CARD ************//
$("#delete_id_card_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

     csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-id-card') }}",
        method: "post",
        data: {
            user_id: "{{ $user->id }}",
        },
        success: function (response){
            if(response.not_exist){
                bottom_alert_error('User does not exist!')
            }else if(response.data){
                $("#member_id_card img").attr('src', response.data)
                $(".delete-id-card-btn-open").hide()
                bottom_alert_success('ID card deleted successfully!')
               $("#ul_id_card_body").html("<li><div class='title'>Member ID CARD  </div><div class='body'>: None</div></li>")
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})








// *************** OPEN ADD PROFILE IMAGE **************//
// $(".open-add-profile-image").click(function(e){
//     e.preventDefault()
//     $("#profile_image_input").click()
// })






// // ********** ADD  PROFILE IMAGE **************//
// $("#profile_image_input").on('change', function(e){
//     e.preventDefault()
// 	var image = $("#profile_image_input");
//     $("#access_preloader_container").show()
    
//     if(validate_image(e))
//     {
//         return bottom_alert_error('Image type must be jpg, jpeg, png!')
//     }
    
//     csrf_token() //csrf token

// 	var data = new FormData();
// 	var image = $(image)[0].files[0];

//     data.append('user_id', "{{ $user->id }}");
//     data.append('image', image);

// 	$.ajax({
//         url: "{{ url('/admin/ajax-add-user-profile-image') }}",
//         method: "post",
//         data: data,
//         contentType: false,
//         processData: false,
//         success: function (response){
//            if(response.error){
//                 bottom_alert_error(response.error.image)
//            }else if(response.data){
//                 $(".user-profile-img img").attr('src', response.data)
//                 bottom_alert_success('Profile image added successfully!')
//            }else{
//                 bottom_alert_error('Network error, try again later!')
//            }
//            $("#profile_image_input").val("")
//            $("#access_preloader_container").hide()
// 		},
// 		error: function(){
//             $("#profile_image_input").val("")
//             $("#access_preloader_container").hide()
//             bottom_alert_error('Network error, try again later!')
// 		}
//     });
// })








// function validate_image(e){
//     var state = true;
//     var file = e.target.files
//     var extension = file[0].type;
    
//     if(extension == 'image/jpeg' || extension == 'image/png'){
//         state = false;
//     }else{
//         state = true;
//         $("#profile_image_input").val('')
//         $("#access_preloader_container").hide()
//     }
//     return state;
// }







// ************ OPEN IMAGE INPUT **************//
var cropper = null;
var canvas = null;
$(".profile-image-iconx").click(function(e){
    e.preventDefault()

     if(cropper)
    {
        cropper.destroy();
        cropper = null;
    }

    $("#profile_image_input").val('')
    $("#profile_image_input").click()
})





// *********** UPLOAD IMAGE TO CROPPER ***********//
var image = $("#cropper_sample_img")
$("#profile_image_input").change(function(e){
    var file = e.target.files
    var extension = file[0].type;
    var type = extension.split('/')[1]
    
    if(type != 'jpeg' && type != 'png'){
        $("#profile_image_input").val('')
        return bottom_alert_error('Image type must be jpg, jpeg, png!')
    }

    var done = function(url){
        $(image).attr('src', '');
        $(image).attr('src', url)
        $("#cropper_modal_popup_box").show()
    }

    if(file && file.length > 0){
        reader = new FileReader()
        reader.onload = function(event){
            done(reader.result)
        }
        reader.readAsDataURL(file[0])
    }
})











// DISPLAY IMAGE CROPPER ON IMAGE
function image_cropper(){
    $(image).on('load', function(e){
        cropper = new Cropper(e.target, {
            aspectRatio: 1,
            viewMode: 3
        });
    });
}
image_cropper(); //crop image




// CROP IMAGE
$("#cropper_confirm_submit_btn").click(function(e){
    e.preventDefault();
    canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500
        });

    canvas.toBlob(function(blob){
        var image_url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);

        reader.onloadend = function(){
            var base64data = reader.result;
            upload_image(base64data);
        }
    });
});






// UPLOAD CROPPED IMAGE
function upload_image(base64data){
    $(".modal-alert-popup").hide()
    $("#access_preloader_container").show()

    csrf_token()   // gets page csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-add-user-profile-image') }}",
        method: "post",
        data: {
            image: base64data,
            user_id: "{{ $user->id }}"
        },
        success: function (response){
            if(response.data){
                $(".user-profile-img img").attr('src', response.data)
                bottom_alert_success('Profile image uploaded successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#profile_image_input").val('')
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#profile_image_input").val('')
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}











// ******** DELETE PROFILE IMAGE MODAL OPEN ************//
$("#open_profile_image_delete").click(function(e){
    e.preventDefault()
    $("#delete_user_profile_img_modal_popup_box").show()
    $("#delete_user_profile_img_confirm_submit_btn").html("Proceed")
})









// ******** DELETE PROFILE IMAGE ************//
$("#delete_user_profile_img_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')
    var btn = $(this);

     csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-user-profile-image') }}",
        method: "post",
        data: {
            user_id: "{{ $user->id }}",
        },
        success: function (response){
            if(response.no_avatar){
                bottom_alert_error('Empty Profile Image!')
            }else if(response.data){
              console.log(response.data)
                $(".user-profile-img img").attr('src', response.data)
                bottom_alert_success('Profile image deleted successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})








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