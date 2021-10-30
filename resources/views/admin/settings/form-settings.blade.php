


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
                                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                <li class="breadcrumb-item"><a href="#">Form Settings</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Form Settings</h4>
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
                    <div class="profile-detail-container">
                        <div class="row">
                            <div class="col-xl-12 expand"><!-- profile detail left end-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Form Details</h4> 
                                    </div>
                                    <div class="banner-slider-body" id="banner_slider_body">
                                       <div class="form-body-settings">
                                            <form action="{{ url('/admin/member-register-page') }}" method="POST" class="parsley-examples">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="title" parsley-trigger="change" placeholder="Title" class="form-control" value="{{ $register_detail['title'] }}">
                                                            <div class="alert-form text-danger">@if($errors->first('title')) {{ $errors->first('title') }} @endif</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="title_small" parsley-trigger="change" placeholder="Second Title" class="form-control" value="{{ $register_detail['title_small'] }}">
                                                            <div class="alert-form text-danger">@if($errors->first('title_small')) {{ $errors->first('title_small') }} @endif</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="form-group">
                                                        <textarea name="body" class="form-control" cols="10" rows="3" placeholder="Body">{{ $register_detail['body'] }}</textarea>
                                                            <div class="alert-form text-danger">@if($errors->first('body')) {{ $errors->first('body') }} @endif</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="form-group">
                                                        <textarea name="body_small" class="form-control" cols="10" rows="3" placeholder="Second Body">{{ $register_detail['body_small'] }}</textarea>
                                                            <div class="alert-form text-danger">@if($errors->first('body_small')) {{ $errors->first('body_small') }} @endif</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group text-right mb-3">
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-success pt-2 float-left">
                                                            <input id="feature_checker_item" name="is_feature" type="checkbox" {{ $register_detail['is_feature'] ? 'checked' : '' }}>
                                                            <label for="feature_checker_item">Feature</label>
                                                        </div>
                                                        <button type="submit" class="btn-mini">Update</button>
                                                    </div>
                                                    @csrf
                                                </div>
                                            </form>
                                        </div>
                                        <br><br><br>
                                        <div class="title-header">
                                            <h4><b>Form slider</b></h4> 
                                        </div>
                                        <div class="row">
                                            @if(count($sliders))
                                            @foreach($sliders as $slider)
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> <!-- slider banner start-->
                                                <ul class="ul-slide-banner">
                                                    <li class="child-slide-img"><img src="{{ asset($slider->banner) }}" alt=""></li>
                                                    <li class="banner-slider-icon">
                                                        <a href="#" id="{{ $slider->id }}" class="slider-edit-icon update_banner_icon"><i class="fa fa-camera"></i></a>
                                                        <a href="#" id="{{ $slider->id }}" class="slider-delete-icon delete_banner_icon"><i class="fa fa-trash"></i></a>
                                                    </li>
                                                    <li>
                                                        <div class="checkbox checkbox-success pt-2">
                                                            <input id="feature_checker_{{ $slider->id }}" data-id="{{ $slider->id }}" type="checkbox" class="feature_slider_checkbox_input"  {{ $slider->is_featured ? 'checked' : '' }}>
                                                            <label for="feature_checker_{{ $slider->id }}">Feature</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div><!-- slider banner end-->
                                            @endforeach
                                            @endif
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> <!-- slider banner start-->
                                                <ul class="ul-slide-banner">
                                                   <li class="text-center">
                                                        <input type="file" id="slider_banner_input" style="display: none;">
                                                        <input type="file" id="update_slider_banner_input" style="display: none;">
                                                        <a href="#" id="slider_banner_btn_open" class="upload-slider-icon"><i class="fa fa-camera"></i></a>
                                                        <div>Max: 1MB</div>
                                                        <div class="alert-form image_alert_0 text-danger"></div>
                                                    </li>
                                                </ul>
                                            </div><!-- slider banner end-->
                                        </div>
                                    </div>
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










<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_banner_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this banner image</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_banner_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->








































<script>
$(document).ready(function(){
// *********** OPEN SLIDER FILE INPUT ************//
$("#banner_slider_body").on('click', '#slider_banner_btn_open', function(e){
    e.preventDefault()
    $(".image_alert_0").html('')
    $("#slider_banner_input").click()
})





// ********** UPLOAD SLIDER **************//
$("#banner_slider_body").on('change', '#slider_banner_input', function(e){
    e.preventDefault()
	var image = $("#slider_banner_input");
    $("#access_preloader_container").show()
    

	var data = new FormData();
	var image = $(image)[0].files[0];

    data.append('image', image);

	$.ajax({
        url: "{{ url('/admin/ajax-add-form-slider') }}",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
           if(response.error){
               $(".image_alert_0").html(response.error.image)
               $("#access_preloader_container").hide()
           }else if(response.data){
                get_sliders()
           }
		},
		error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
		}
    });
})




// ********** GET SLIDERS ***************//
function get_sliders(){
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-get-form-slider') }}",
        method: "post",
        data: {
            slider: 'slider'
        },
        success: function (response){
            if(response.data == false){
                location.reload()
                return
            }
            $("#banner_slider_body").html(response)
            $("#access_preloader_container").hide()
            bottom_alert_success('Slider uploaded successfully!')
        },
        error: function()
        {
            $("#access_preloader_container").hide()
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







// ************ DELETE BANNER IMAGE *************//
var banner_id = null;
var banner_parent = null;
$("#banner_slider_body").on('click', '.delete_banner_icon', function(e){
    e.preventDefault()
    $(".image_alert_0").html('')
    banner_id = $(this).attr('id')
    banner_parent = $(this).parent().parent().parent()
    $("#delete_banner_modal_popup_box").show()
    $("#delete_banner_confirm_submit_btn").html("Proceed")
})






$("#delete_banner_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html("Please wait...")

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-form-slider') }}",
        method: "post",
        data: {
            banner_id: banner_id
        },
        success: function (response){
            if(response.data){
                $(banner_parent).remove()
                bottom_alert_success('Banner delete successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
            console.log(response)
        },
        error: function()
        {
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})











// ************ UPDATE BANNER IMAGE *************//
var image_container = null;
$("#banner_slider_body").on('click', '.update_banner_icon', function(e){
    e.preventDefault()
    $(".image_alert_0").html('')
    banner_id = $(this).attr('id')
    image_container = $(this).parent().parent().children('.child-slide-img')
    $("#update_slider_banner_input").click()
})









// ********** EDIT  SLIDER IMAGE **************//
$("#banner_slider_body").on('change', '#update_slider_banner_input', function(e){
    e.preventDefault()
	var image = $("#update_slider_banner_input");
    $("#access_preloader_container").show()
    
    csrf_token() //csrf token

	var data = new FormData();
	var image = $(image)[0].files[0];

    data.append('image', image);
    data.append('banner_id', banner_id);

	$.ajax({
        url: "{{ url('/admin/ajax-update-form-slider') }}",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
           if(response.error){
               $(".image_alert_0").html(response.error.image)
           }else if(response.data){
                $(image_container).children('img').attr('src', response.data)
                bottom_alert_success('Slider updated successfully!')
           }else{
                bottom_alert_error('Network error, try again later!')
           }
           $("#access_preloader_container").hide()
		},
		error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
		}
    });
})








// ********** FEATURE / UNFEATURE SLIDER ***********//
$("#banner_slider_body").on('click', '.feature_slider_checkbox_input', function(e){
    var item_id = $(this).attr('data-id')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-feature-form-slider') }}",
        method: "post",
        data: {
            banner_id: item_id
        },
        success: function (response){
            console.log(response)
        }
    });
})












       
// end
})
</script>




