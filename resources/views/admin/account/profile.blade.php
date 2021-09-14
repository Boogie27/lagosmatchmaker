
<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void()">Account</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Account Profile</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <div class="">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                    <div class="profile-img-container">
                                        @php($image = admin_image($admin->image, $admin->gender))
                                       <div class="inner-image" id="admin_profile_image" style="background-image: url('{{ asset($image) }}')">
                                            <div class="img-loader-container" id="img_preloader">
                                                <div class="img-loader"></div>
                                            </div>
                                            <a href="#" class="profile-image-icon"><i class="fa fa-camera"></i></a>
                                            <input type="file" id="profile_image_input" style="display: none;">
                                       </div>
                                    </div>
                                    <form action="{{ url('/admin/profile') }}" method="POST" class="parsley-examples">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="userName">First name<span class="text-danger">*</span></label>
                                                    <input type="text" name="first_name" parsley-trigger="change" placeholder="Enter first name" class="form-control" value="{{ $admin->first_name ?? old('first_name') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('first_name')) {{ $errors->first('first_name') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="userName">Last name<span class="text-danger">*</span></label>
                                                    <input type="text" name="last_name" parsley-trigger="change" placeholder="Enter last name" class="form-control" value="{{ $admin->last_name ?? old('last_name') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('last_name')) {{ $errors->first('last_name') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="userName">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" parsley-trigger="change" placeholder="Enter email" class="form-control" value="{{ $admin->email ?? old('email') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('email')) {{ $errors->first('email') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="userName">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="city" parsley-trigger="change" placeholder="Enter city" class="form-control" value="{{ $admin->city ?? old('city') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('city')) {{ $errors->first('city') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="emailAddress">State<span class="text-danger">*</span></label>
                                                    <select name="state"  class="selectpicker form-control">
                                                        <option value="">Select state</option>
                                                        @if(count($states))
                                                            @foreach($states as $state)
                                                            <option value="{{ $state->state }}" {{  $state->state == strtoupper($admin->state) ? 'selected' : '' }}>{{ strtolower($state->state) }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="alert-form text-danger">@if($errors->first('state')) {{ $errors->first('state') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="userName">Country<span class="text-danger">*</span></label>
                                                    <input type="text" name="country" parsley-trigger="change" placeholder="Enter country" class="form-control" value="{{ $admin->country ?? old('country') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('country')) {{ $errors->first('country') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="emailAddress">About<span class="text-danger">*</span></label>
                                                    <textarea name="about"  class="form-control" cols="30" rows="5" placeholder="Write something..">{{ $admin->about ?? old('about') }}</textarea>
                                                    <div class="alert-form text-danger">@if($errors->first('about')) {{ $errors->first('about') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-16">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="male_type_checker" type="checkbox" class="gender_checkbox_input" value="male" {{ $admin->gender == 'male' ? 'checked' : '' }}>
                                                                <label for="male_type_checker">Male</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-16">
                                                            <div class="checkbox checkbox-success">
                                                                <input id="female_type_checker" type="checkbox" class="gender_checkbox_input" value="female" {{ $admin->gender == 'female' ? 'checked' : '' }}>
                                                                <label for="female_type_checker">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="alert-form text-danger">@if($errors->first('gender')) {{ $errors->first('gender') }} @endif</div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group text-right mb-3">
                                                    <div class="form-group">
                                                        <input type="hidden" name="gender" class="admin_gender_input" value="{{ $admin->gender }}">
                                                        <button type="submit" id="admin_update_submit" class="btn-fill-block">Update profile</button>
                                                    </div>
                                                    @csrf
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                               </div>
                            </div>
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->












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
                    <img src="{{ asset('admins/images/profile_image/male.png') }}" alt="" id="cropper_sample_img">
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












<script>
$(document).ready(function(){
// *********** UPDATE BUTTON *********//
$("#admin_update_submit").click(function(e){
    $(this).html('Please wait...')
    $("#access_preloader_container").show()
})







// ********** GENDER INPUT ************//
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
    $(".admin_gender_input").val($(this).val());
});











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
    var url = $(this).attr('href');

    canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400
        });

    canvas.toBlob(function(blob){
        var image_url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);

        reader.onloadend = function(){
            var base64data = reader.result;
            upload_image(url, base64data);
        }
    });
});






// UPLOAD CROPPED IMAGE
function upload_image(url, base64data){
    $(".modal-alert-popup").hide()
    $("#img_preloader").show()

    csrf_token()   // gets page csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-profile-upload-image') }}",
        method: "post",
        data: {
            image: base64data
        },
        success: function (response){
            if(response.data){
                $(".admin-profile-image").attr('src', response.data)
                $("#admin_profile_image").css({ backgroundImage: 'url('+response.data+')' })
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#img_preloader").hide()
            $("#profile_image_input").val('')
        }, 
        error: function(){
            $("#img_preloader").hide()
            $("#profile_image_input").val('')
            bottom_alert_error('Network error, try again later!')
        }
    });
}





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}


// end of ready function
})
</script>