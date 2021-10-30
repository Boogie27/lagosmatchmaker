@php($settings = settings())
@php( $banners = json_decode($settings->register_form_detail, true))

<!-- LOGIN START-->
<section class="login-form-section {{ $banners && !$banners['is_feature'] ? 'small' : '' }}"  style="background-image: url({{ asset('web/images/banner/night-sky.gif') }})">
    <div class="form-container">
        <div class="row expand">
            @if($banners && $banners['is_feature'])
            <div class="col-xl-6"><!-- left section start-->
                <div class="register-form-content">
                    <ul class="ul-left-content">
                        @if($banners['title'])
                        <li><h3>{{ $banners['title'] }}</h3></li>
                        @endif
                        @if($banners['body'])
                        <li>
                            <p class="break">{{ $banners['body'] }}</p>
                        </li>
                        @endif

                        @if(count($sliders))
                         <li class="register-img" id="content_swipper_container">
                            @foreach($sliders as $slider)
                            <img src="{{ asset($slider->banner) }}" alt="" class="swipper-content">
                            @endforeach
                        </li>
                        @endif
                        <li>
                            @if($banners['title_small'])
                            <h4>{{ $banners['title_small'] }}</h4>
                            @endif 
                            @if($banners['body_small'])
                            <p>{{ $banners['body_small'] }}</p>
                            @endif
                        </li>
                    </ul>
                </div>
            </div><!-- left section end-->
            @endif
            <div class="col-xl-{{ $banners && $banners['is_feature'] ? '6' : '12' }}"> <!-- right section start-->
                <form action="{{ url('/register') }}" method="POST" class"register">
                    @if(Session::has('error'))
                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                    @endif
                    <div class="title-header text-center">
                        <h3>Register</h3>
                        <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <div class="alert-form alert_username text-danger"></div>
                                <input type="text" id="register_user_name" class="form-control" value="" placeholder="User Name">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <div class="alert-form alert_email text-danger"></div>
                                <input type="email" id="register_email" class="form-control" value="" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <div class="alert-form alert_password text-danger"></div>
                                <input type="password" id="register_password" class="form-control" value="" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <div class="alert-form alert_confirm_password text-danger"></div>
                                <input type="password" id="register_confirm_password" class="form-control" value="" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <div class="alert-form alert_phone text-danger"></div>
                                <input type="text" id="register_phone" class="form-control" value="" placeholder="Phone number">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="alert-form alert_gender text-danger"></div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6-col-sm-6 col-6">
                                    <div class="form-group">
                                        <input type="checkbox" class="gender_checkbox_input" value="male"> <span>Male</span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6-col-sm-6 col-6">
                                    <div class="form-group">
                                        <input type="checkbox" class="gender_checkbox_input" value="female"> <span>Female</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-4">
                            <div class="form-group">
                                <input type="hidden" id="member_gender_input" value="">
                                <button type="submit" id="register_form_submit" class="btn-fill-block">Get Started Now</button>
                            </div>
                            @csrf
                        </div>
                    </div>
                </form>
            </div><!-- right section end-->
        </div>
    </div>
</section>
<!-- LOGIN END-->












<!--  PROFILE MODAL START -->
<section class="modal-alert-popup" id="cropper_modal_popup_box">
    <div class="sub-confirm-container" id="">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content cropper">
                <div class="text-right">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="cropper-form" id="profile_image_cropper">
                    <div class="inner-cropper-img">
                        <img src="{{ asset('web/images/avatar/male.png') }}" alt="" id="cropper_sample_img">
                    </div>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST" class="upload-img-form">
                        <a href="#" class="gallery-btn" id="open_gallery_btn"><i class="fa fa-image"></i></a>
                        <input type="file" id="profile_image_input" style="display: none;">
                        <button type="button"  id="cropper_confirm_submit_btn" class="btn-empty">
                            <i class="fa fa-arrow-up"></i>
                            Upload image
                        </button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  PROFILE MODAL ALERT END -->









<!--  PROFILE MODAL START -->
<section class="modal-alert-popup" id="profile_img_option_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content cropper">
                <div class="confirm-header">
                    <h3>Profile Photo</h3>
                    <p class="text">Your uploaded picture cannot be viewed by anyone except the people you choose to match with</p>
                </div>
                <div class="profile-option-content">
                
                    <ul>
                        <li>
                            <a href="#" class="delete confirm-box-close"><i class="fa fa-trash"></i></a>
                            <div class="text">Cancle</div>
                        </li>
                        <li>
                            <a href="#" class="profile-image-icon add"><i class="fa fa-image"></i></a>
                            <div class="text">Gallery</div>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--  PROFILE MODAL ALERT END -->





<script>
$(document).ready(function(){
// *********** ASSIGN GENDER FIELD **********//
function get_gender(){
    var gender = $(".gender_checkbox_input");
    $.each($(".gender_checkbox_input"), function(index, current){
        $(this).click(function(){
            for(var i = 0; i < gender.length; i++){
                if(index != i)
                {
                $($(gender)[i]).prop('checked', false);
                }else{
                    $($(gender)[i]).prop('checked', true);
                }
            }
        });
    });


    $(gender).click(function(){
        $("#member_gender_input").val($(this).val());
    });
}
get_gender()












// ********** SWIPE IMAGE **********//
var counter = 0
function content_swipper(){
    var container = $("#content_swipper_container")
    var content = $(container).children()

    for(var i = 0; i < content.length; i++){
        $(content[counter]).css({
            opacity: 0,
            transition: 'all 0.5s ease'
        })
    }
   
   if(counter >= content.length - 1){
       counter = 0
   }else{
       counter++
   }

   $(content[counter]).css({
       opacity: 1,
       transition: 'all 0.5s ease'
   })

    setTimeout(function(){
        content_swipper()
    }, 10000)
}

content_swipper()









// ************ REGISTER MEMBERS *********//
$("#register_form_submit").click(function(e){
    e.preventDefault()
    register_member()
})






function register_member(){
    $(".alert-form").html('')
    var username = $("#register_user_name").val()
    var email = $("#register_email").val()
    var password = $("#register_password").val()
    var confirm_password = $("#register_confirm_password").val()
    var phone = $("#register_phone").val()
    var gender = $("#member_gender_input").val()

    $("#register_form_submit").html('Please wait...')

     csrf_token() //csrf token

    if(validate_field(username, email, password, confirm_password, phone, gender)){
        $("#register_form_submit").html('Get Started Now')
        return;
    }
    
    $.ajax({
        url: "{{ url('/register-new-members') }}",
        method: "post",
        data: {
            username: username,
            email: email,
            password: password,
            confirm_password: confirm_password,
            phone: phone,
            gender: gender,
        },
        success: function (response){
            if(response.error){
                get_field_error(response.error)
            }else if(response.data){
                clear_input_field()
               $("#profile_img_option_modal_popup_box").show()
            }else{
                return bottom_alert_error('Network error, try again later!')
            }
            $("#register_form_submit").html('Get Started Now')
        },
        error: function(){
            $("#register_form_submit").html('Get Started Now')
            return bottom_alert_error('Network error, try again later!')
        }
    });
}





// ******* CLEAR INPUT FIELD ************//
function clear_input_field(){
    $("#register_email").val('')
    $("#register_phone").val('')
    $("#register_password").val('')
    $("#register_user_name").val('')
    $("#register_confirm_password").val('')
    $(".gender_checkbox_input").prop('checked', false)
}





// *********** VALIDATE INPUT FIELDS ************//
function validate_field(username, email, password, confirm_password, phone, gender){
    var is_state = false;

    if(!username || !email || !password || !confirm_password || !phone || !gender){
        is_state = true;
        bottom_alert_error('*All fields are required!')
    }else{
        if(username.length < 3){
            is_state = true;
            $(".alert_name").html('*Minimum of 3 characters')
        }
        if(username.length > 50){
            is_state = true;
            $(".alert_name").html('*Maximum of 50 characters')
        }
        if(password.length < 6){
            is_state = true;
            $(".alert_password").html('*Minimum of 6 characters')
        }
        if(password.length > 12){
            is_state = true;
            $(".alert_password").html('*Maximum of 12 characters')
        }
        if(confirm_password !== password){
            is_state = true;
            $(".alert_confirm_password").html('*Confirm password must equall to Password')
        }
        if(phone.length > 13){
            is_state = true;
            $(".alert_phone").html('*Wrong Phone number format')
        }
        if(phone.length < 11){
            is_state = true;
            $(".alert_phone").html('*Wrong Phone number format')
        }
    }
    return is_state;
}








function get_field_error(error){
    $(".alert_username").html(error.username)
    $(".alert_email").html(error.email)
    $(".alert_password").html(error.password)
    $(".alert_confirm_password").html(error.confirm_password)
    $(".alert_phone").html(error.phone)
    $(".alert_gender").html(error.gender)
}








// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}







// ************ OPEN IMAGE INPUT **************//
var cropper = null;
var canvas = null;
$(".profile-image-icon").click(function(e){
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
    $("#profile_img_option_modal_popup_box").hide()
    
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
        url: "{{ url('/ajax-add-registered-profile-image') }}",
        method: "post",
        data: {
            image: base64data
        },
        success: function (response){
            if(response.data){
                location.assign(response.data)
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




// end
})
</script>










