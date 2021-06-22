




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
                                <li class="breadcrumb-item"><a href="javascript: void()">Options</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Marital status</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Marital status</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="header-title mt-0 mb-1">Buttons example</h4> -->
                               <div class="table-top pb-2">
                                    <a href="#" id="add_content_btn" class="mini-btn">Add Marital Status</a>
                               </div>
                               <div class="table-responsive"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Marital status</th>
                                                <th>Featured</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($marital_status))
                                            @foreach($marital_status as $marital)
                                            <tr>
                                                <td>
                                                    <div class="genotype-name">{{ ucfirst($marital->marital_status) }}</div>
                                                </td>
                                                <td>
                                                    <div class="check-box {{ $marital->is_featured ? 'active' : ''}}">
                                                        <a href="#" data-name="{{ $marital->marital_status }}" id="{{ $marital->id }}" class="feature-confirm-box-open"></a>
                                                    </div>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($marital->date)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="#" data-name="{{ $marital->marital_status }}" id="{{ $marital->id }}" class="content-edit-btn">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-name="{{ $marital->marital_status }}" id="{{ $marital->id }}" class="content-delete-btn">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div><!-- table end-->
                                <div id="bottom_table_part">
                                    @if(!count($marital_status))
                                    <div class="text-center">There are no marital status yet!</div>
                                    @endif
                                    @if(count($marital_status))
                                    <div class="paginate">{{ $marital_status->links("pagination::bootstrap-4") }}</div>
                                    @endif
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->













<!-- EDIT GENOTYPE ALERT START -->
<section class="modal-alert-popup" id="genotype_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="text-left">
                   <form action="" method="POST">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="userName">Marital status<span>*</span></label>
                                <input type="text" parsley-trigger="change" id="form_content_input" placeholder="Enter marital status" class="form-control" value="">
                                <div class="alert-form alert_0 text-danger"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                                <input type="hidden" id="options_id_input">
                                <button type="button"  id="form_confirm_submit_btn" class="btn-fill">Proceed</button>
                                @csrf
                           </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- EDIT GENOTYPE ALERT END -->









<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this items <br><b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="options_delete_id_input">
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
<section class="modal-alert-popup" id="feature_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this items <br><b>example</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="feature_id_input">
                        <button type="button"  id="feature_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->














<!-- ADD GENOTYPE ALERT START -->
<section class="modal-alert-popup" id="add_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="text-left">
                   <form action="" method="POST">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="userName">Marital status<span>*</span></label>
                                <input type="text" parsley-trigger="change" id="add_form_content_input" placeholder="Enter marital status" class="form-control" value="">
                                <div class="alert-form alert_0 text-danger"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                                <button type="button"  id="add_confirm_submit_btn" class="btn-fill">Proceed</button>
                                @csrf
                           </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ADD GENOTYPE ALERT END -->








































































<script>
$(document).ready(function(){

// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#parent_table").children()
    if(table.length == 0){
        $("#bottom_table_part").html("<div class='text-center'>There are no marital status yet!</div>")
    }
}







// ************ OPEN CONFIRM MODAL **************//
var dataName = null;
var content_parent = null;
$(".content-edit-btn").click(function(e){
    e.preventDefault()
    dataName = $(this)
    $(".alert-form").html('')
    var name = $(this).attr('data-name')
    var id =  $(this).attr('id')
   
    content_parent = $(this).parent().parent().parent().parent().parent().children().children('.genotype-name')
    $("#form_content_input").val(name)
    $("#options_id_input").val(id)
    $("#genotype_modal_popup_box").show()
    $("#form_confirm_submit_btn").html('Proceed')
})







// *********** EDIT MARITAL STATUS **************//
$("#form_confirm_submit_btn").click(function(e){
    e.preventDefault()
    edit_marital_status()
})


// ******* EDIT MARITAL STATUS ON ENTER **********//
$("#form_content_input").keypress(function(e){
    if(e.which == 13){
        e.preventDefault()
        edit_marital_status()
    }
})



function edit_marital_status(){
    $(".alert-form").html('')
    var marital_status =$("#form_content_input").val()
    var id = $("#options_id_input").val()
    $("#form_confirm_submit_btn").html('Please wait...')

    if(validate_form(marital_status)){
        $("#form_confirm_submit_btn").html('Proceed')
        return;
    }

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-edit-marital-status') }}",
        method: "post",
        data: {
            id: id,
            marital_status: marital_status,
        },
        success: function (response){
            if(response.error){
                $(".alert_0").html(response.error.marital_status)
            }else if(response.data){
                $(content_parent).html(marital_status)
                $(".modal-alert-popup").hide()
                $(dataName).attr('data-name', marital_status)
                bottom_alert_success('Marital status has been updated!')
            }else{
                $(".modal-alert-popup").hide()
                bottom_alert_error('Network error, try again later!')
            }
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}




function validate_form(marital_status){
    var state = false;
    if(marital_status == ''){
        state = true;
        $(".alert_0").html('*Marital status field is required')
    }else if(marital_status.length > 50){
        state = true;
        $(".alert_0").html('*Maximum of 50 characters')
    }
    return state;
}



// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#delete_modal_popup_box").find('.confirm-header').html(message)
    $("#feature_modal_popup_box").find('.confirm-header').html(message)
}





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}









// ************ OPEN DELETE CONFIRM MODAL **************//
var content_parent = null;
$(".content-delete-btn").click(function(e){
    e.preventDefault()
    var name = $(this).attr('data-name')
    var id =  $(this).attr('id')
   
    content_parent = $(this).parent().parent().parent().parent().parent()
    $("#options_delete_id_input").val(id)
    $("#delete_modal_popup_box").show()
    $("#delete_confirm_submit_btn").html('Proceed')
    apend_message("<p>Do you wish to delete the marital status <br><b>"+name+"</b></p>")
})








// *********** DELETE MARITAL STATUS **************//
$("#delete_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var id = $("#options_delete_id_input").val()
    $("#delete_confirm_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-marital-status') }}",
        method: "post",
        data: {
            id: id,
        },
        success: function (response){
            if(response.data){
                $(content_parent).remove()
                $(".modal-alert-popup").hide()
                bottom_alert_success('Marital status has been deleted!')
                table_check()
            }else{
                $(".modal-alert-popup").hide()
                bottom_alert_error('Network error, try again later!')
            }
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})







// **********ADD MARITAL STATUS MODAL OPEN *************//
$("#add_content_btn").click(function(e){
    e.preventDefault()
    $(".alert-form").html('')
    $("#add_modal_popup_box").show()
})


// ******* ADD MARITAL STATUS ON ENTER ************//
$("#add_form_content_input").keypress(function(e){
    if(e.which == 13){
        e.preventDefault()
        add_content()
    }
})



// ********** ADD MARITAL STATUS ***********//
$("#add_confirm_submit_btn").click(function(e){
    e.preventDefault()
    add_content()
})




function add_content(){
    $(".alert-form").html('')
    var marital_status =$("#add_form_content_input").val()
    $("#add_confirm_submit_btn").html('Please wait...')

    if(validate_form(marital_status)){
        $("#add_confirm_submit_btn").html('Proceed')
        return;
    }


    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-add-marital-status') }}",
        method: "post",
        data: {
            marital_status: marital_status,
        },
        success: function (response){
            if(response.error){
                $(".alert_0").html(response.error.marital_status)
            }else if(response.data){
                location.reload()
            }else{
                $(".modal-alert-popup").hide()
                bottom_alert_error('Network error, try again later!')
            }
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}








// ************ OPEN FEATURE CONFIMR BOX *********//
var featured = null;
$(".feature-confirm-box-open").click(function(e){
    e.preventDefault()
    featured = $(this).parent()
    var content = $(this).attr('data-name')
    var id =  $(this).attr('id')
   
    $("#feature_id_input").val(id)
    $("#feature_confirm_submit_btn").html('Proceed')
    $("#feature_modal_popup_box").show()
    if($(featured).hasClass('active')){
        apend_message("<p>Do you wish to unfeature the marital status <br><b>"+content+"</b></p>")  
    }else{
        apend_message("<p>Do you wish to feature the marital status <br><b>"+content+"</b></p>") 
    }
})





// *********** TOGGLE FEATURED GENOTYPE ************//
$("#feature_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var id = $("#feature_id_input").val()
    $("#feature_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-feature-marital-status') }}",
        method: "post",
        data: {
            id: id,
        },
        success: function (response){
            if(response.featured){
                $(featured).addClass('active')
                bottom_alert_success('Marital status has been featured!')
            }else if(response.unfeatured){
                $(featured).removeClass('active')
                bottom_alert_success('Marital status has been unfeatured!')
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





// end
})
</script>












