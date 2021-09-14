


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
                                <li class="breadcrumb-item"><a href="#">Subscription</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manual Subscription</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Manual Subscription</h4>
                        <div class="top-alert">
                            @if(Session::has('error'))
                            <div class="main-alert-danger top-alert text-center mt-3">{{ Session::get('error')}}</div>
                            @endif
                            @if(Session::has('success'))
                            <div class="main-alert-success top-alert text-center mt-3">{{ Session::get('success')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
               
                <!-- PROFILE DETAILS START-->
                <div class="profile-detail-section">
                    <div class="profile-detail-container">
                        <div class="row">
                            <div class="col-xl-12"><!-- profile detail left end-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Bank icons</h4>
                                    </div>
                                    <ul class="ul-bank-icons" id="ul_bank_icons">
                                        @if($images)
                                            @foreach($images as $key => $image)
                                            <li class="bank-icons">
                                                <img src="{{ asset($image) }}" alt="">
                                                <a href="#" id="{{ $key }}" class="delete-bank-icon-btn"><i class="fa fa-times text-danger"></i></a>
                                            </li>
                                            @endforeach
                                        @endif
                                        <li class="bank-icons text-icons">
                                            <a href="#" id="upload_bank_icon_input" class="add-bank-icon"><i class="fa fa-camera"></i></a>
                                            <input type="file" id="upload_bank_icon_btn" style="display: none;">
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- profile detail left end-->

                            <div class="col-xl-12"><!-- profile detail left end-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Payment Description</h4>
                                    </div>
                                    <ul class="ul-payemt-desc" id="ul_payemt_desc">
                                        @if($descriptions)
                                            @php($x = 1)
                                            @foreach($descriptions as $key => $description)
                                            <li class="li-payment-desc">
                                                <span>{{ $x }}.</span> <p class="description-p">{{ $description }}</p>
                                                <div class="text-right">
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-v drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li class="text-left">
                                                                <a href="#" data-name="{{ $description }}" id="{{ $key }}"class="edit-description-btn">Edit</a>
                                                                <a href="#" data-name="{{ $description }}" id="{{ $key }}" class="delete-description-btn">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @php($x++)
                                            @endforeach
                                        @else
                                        <div style="font-size: 11px;">Add Subscription descriptions, this would help users navigate manual payment option</div>
                                        @endif
                                    </ul>
                                    <div class="form-desc-add">
                                        <form action="{{ url('/admin/manual-subscription') }}" method="POST">
                                            <div class="desc-form-group">
                                                <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Write something...">
                                                <button type"submit">Add</button>
                                            </div>
                                            @if($errors->first('description'))
                                            <div class="alert-form text-danger">{{ $errors->first('description') }}</div>
                                            @endif
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- profile detail left end-->

                            <div class="col-xl-12"><!-- profile detail left end-->
                            <br><br><br>
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Personalized Matching</h4>
                                    </div>
                                    <div class="p-3">
                                        <form action="{{ url('/admin/personalized-matching') }}" method="POST">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $personalized['title'] ?? old('title') }}" placeholder="Title">
                                                @if($errors->first('title'))
                                                <div class="alert-form text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="">Head</label>
                                                <input type="text" name="head" class="form-control" value="{{ $personalized['head'] ?? old('head') }}" placeholder="head">
                                                @if($errors->first('head'))
                                                <div class="alert-form text-danger">{{ $errors->first('head') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="descriptions" class="form-control" cols="30" rows="5" placeholder="Write something...">{{ $personalized['descriptions'] ?? old('descriptions') }}</textarea>
                                                @if($errors->first('descriptions'))
                                                <div class="alert-form text-danger">{{ $errors->first('descriptions') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-success">
                                                    <input id="feature_personalized_checker" name="feature_personalized" type="checkbox" class="feature_checkbox_input" value="{{ $personalized['is_feature'] ? 'true' : '' }}" {{ $personalized['is_feature'] ? 'checked' : '' }}>
                                                    <label for="feature_personalized_checker">Feature</label>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn-mini">Update...</button>
                                                @csrf
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <br><br>
                                <div class="profile-detail-left"><!-- friendship matching start -->
                                    <div class="title-header">
                                        <h4>Friendship Matching</h4>
                                    </div>
                                    <div class="p-3">
                                        <form action="{{ url('/admin/friendship-matching') }}" method="POST">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $friendship['title'] ?? old('title') }}" placeholder="Title">
                                                @if($errors->first('title'))
                                                <div class="alert-form text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="">Head</label>
                                                <input type="text" name="head" class="form-control" value="{{ $friendship['head'] ?? old('head') }}" placeholder="head">
                                                @if($errors->first('head'))
                                                <div class="alert-form text-danger">{{ $errors->first('head') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="descriptions" class="form-control" cols="30" rows="5" placeholder="Write something...">{{ $friendship['descriptions'] ?? old('descriptions') }}</textarea>
                                                @if($errors->first('descriptions'))
                                                <div class="alert-form text-danger">{{ $errors->first('descriptions') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-success">
                                                    <input id="feature_friendship_checker" name="feature_friendship" type="checkbox" class="feature_checkbox_input" value="{{ $friendship['is_feature'] ? 'true' : '' }}" {{ $friendship['is_feature'] ? 'checked' : '' }}>
                                                    <label for="feature_friendship_checker">Feature</label>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn-mini">Update...</button>
                                                @csrf
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- friendship matching end -->
                                
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
<section class="modal-alert-popup" id="edit_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p><b>Edit Description</b></p>
                </div>
                <div class="confirm-form mt-3">
                    <form action="" method="POST">
                        <div class="col-xl-12">
                            <div class="form-group text-left">
                                <label for="">Description*</label>
                                <input type="input" id="edit_description_input" class="form-control"value="">
                                <div class="alert-form alert_0 text-danger"></div>
                            </div>
                        </div>
                       <div class="col-xl-12">
                           <div class="form-group">
                                <button type="button"  id="edit_confirm_submit_btn" class="confirm-btn">Proceed</button>
                           </div>
                       </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->












<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this description?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->
















<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_bank_icon_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this Icon?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_bank_icon_confirm_submit_btn" class="confirm-btn">Proceed</button>
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

// *********** FEATURE PERSONALIZED ***********//
$(".feature_checkbox_input").click(function(){
    $(this).val('')
    if($(this).prop('checked')){
       $(this).val(true)
    }
})















//************* OPEN EDIT MODAL **********//
var key = null;
var paragraph = null
$(".edit-description-btn").click(function(e){
    e.preventDefault()
    $(".top-alert").html('')
    key = $(this).attr('id')
    var description = $(this).attr('data-name')
   
    $(".alert_0").html('')
    $("#edit_description_input").val(description)
    $("#edit_modal_popup_box").show()
    paragraph = $(this).parent().parent().parent().parent().parent()
}) 





// ************ EDIT DESCRIPTION *************//
$("#edit_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(".alert_0").html('')
    $(this).html('Please wait...')
    var description = $('#edit_description_input').val()
    
    if(validate_form(description))
    {
        $("#edit_confirm_submit_btn").html('Proceed')
        return
    }
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-edit-subscription-description') }}",
        method: "post",
        data: {
            key: key,
            description: description
        },
        success: function (response){
            if(response.error){
                $(".alert_0").html(response.error.description)
            }else if(response.data){
                $(paragraph).children('.description-p').html(description)
                bottom_alert_success('Description updated successfully!')
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



function validate_form(description){
    var state = false;
    if(description.length == '')
    {
        state = true;
        $(".alert_0").html('*Description field is required')
    }else if(description.length > 500){
        state = true;
        $(".alert_0").html('*Maximum of 500 characters')
    }
    return state
}









// ************ OPEN DELETE DESCRIPTION ***************//
$(".delete-description-btn").click(function(e){
    e.preventDefault()
    $(".top-alert").html('')
    key = $(this).attr('id')
   
    $("#delete_modal_popup_box").show()
    $("#delete_confirm_submit_btn").html('Proceed')
    paragraph = $(this).parent().parent().parent().parent().parent()
}) 






// ************ DELETE DESCRIPTION *************//
$("#delete_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-subscription-description') }}",
        method: "post",
        data: {
            key: key
        },
        success: function (response){
            if(response.data){
                $(paragraph).remove()
                table_check()
                bottom_alert_success('Description delete successfully!')
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






// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#ul_payemt_desc").children()
    if(table.length == 0){
        $("#ul_payemt_desc").html("<div style='font-size: 11px;'>Add Subscription descriptions, this would help users navigate manual payment option</div>")
    }
}







// ************ OPEN DELETE BANK ICON ***************//
$("#ul_bank_icons").on('click', '.delete-bank-icon-btn', function(e){
    e.preventDefault()
    $(".top-alert").html('')
    key = $(this).attr('id')
   
    paragraph = $(this).parent()
    $("#delete_bank_icon_modal_popup_box").show()
    $("#delete_bank_icon_confirm_submit_btn").html('Proceed')
})



// ************ DELETE BANK ICON *************//
$("#delete_bank_icon_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-subscription-bank-icon') }}",
        method: "post",
        data: {
            key: key
        },
        success: function (response){
            if(response.data){
                $(paragraph).remove()
                bottom_alert_success('Icon delete successfully!')
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








// ********* OPEN BANK ICON FILE ***********//
$("#ul_bank_icons").on('click', '#upload_bank_icon_input', function(e){
    e.preventDefault()
    $("#upload_bank_icon_btn").click()
})




// ********** UPLOAD BANK ICONS
$("#ul_bank_icons").on('change', '#upload_bank_icon_btn', function(e){
    e.preventDefault()
	var image = $("#upload_bank_icon_btn");
    $("#access_preloader_container").show()
    
    csrf_token() //csrf token

	var data = new FormData();
	var image = $(image)[0].files[0];

    data.append('image', image);

	$.ajax({
        url: "{{ url('/admin/ajax-add-subscription-bank-icon') }}",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
           if(response.error){
                bottom_alert_error(response.error.image)
           }else if(response.alert_error){
                bottom_alert_error('Network error, try again later!')
           }else{
                $("#ul_bank_icons").html(response)
                bottom_alert_success('Icon added successfully!')
           }
           $("#access_preloader_container").hide()
		},
		error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
		}
    });
})









// end
})
</script>