




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
                                <li class="breadcrumb-item active" aria-current="page">Genotypes</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Genotypes</h4>
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
                               <div class="table-top">
                                    <a href="#" id="add_genotype_btn" class="mini-btn">Add genotype</a>
                                    <div class="table-search">
                                        <form action="" method="GET">
                                            <div class="form-group">
                                                <input type="text" name="search_members" class="form-control" placeholder="Search...">
                                            </div>
                                        </form>
                                    </div>
                               </div>
                               <div class="table-responsive"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Genotype</th>
                                                <th>Featured</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($genotypes))
                                            @foreach($genotypes as $genotype)
                                            <tr>
                                                <td>
                                                    <div class="genotype-name">{{ $genotype->genotype }}</div>
                                                </td>
                                                <td>
                                                    <div class="check-box {{ $genotype->is_featured ? 'active' : ''}}">
                                                        <a href="#" data-name="{{ $genotype->genotype }}" id="{{ $genotype->id }}" class="genotype-confirm-box-open"></a>
                                                    </div>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($genotype->date)) }}</td>
                                                <td>
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li>
                                                                <a href="#" data-name="{{ $genotype->genotype }}" id="{{ $genotype->id }}" class="genotype-edit-btn">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-name="{{ $genotype->genotype }}" id="{{ $genotype->id }}" class="genotype-delete-btn">Delete</a>
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
                                    @if(!count($genotypes))
                                    <div class="text-center">There are no genotype yet!</div>
                                    @endif
                                    @if(count($genotypes))
                                    <div class="paginate">{{ $genotypes->links("pagination::bootstrap-4") }}</div>
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
                                <label for="userName">Genotype<span>*</span></label>
                                <input type="text" parsley-trigger="change" id="genotype_input" placeholder="Enter genotype" class="form-control" value="">
                                <div class="alert-form genotype_0 text-danger"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                                <input type="hidden" id="options_id_input">
                                <button type="button"  id="genotype_confirm_submit_btn" class="btn-fill">Proceed</button>
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
<section class="modal-alert-popup" id="add_genotype_modal_popup_box">
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
                                <label for="userName">Genotype<span>*</span></label>
                                <input type="text" parsley-trigger="change" id="add_genotype_input" placeholder="Enter genotype" class="form-control" value="">
                                <div class="alert-form genotype_0 text-danger"></div>
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
        $("#bottom_table_part").html("<div class='text-center'>There are no genotype yet!</div>")
    }
}







// ************ OPEN CONFIRM MODAL **************//
var genotype_parent = null;
$(".genotype-edit-btn").click(function(e){
    e.preventDefault()
    $(".alert-form").html('')
    var genotype = $(this).attr('data-name')
    var genotype_id =  $(this).attr('id')
   
    genotype_parent = $(this).parent().parent().parent().parent().parent().children().children('.genotype-name')
    $("#genotype_input").val(genotype)
    $("#options_id_input").val(genotype_id)
    $("#genotype_modal_popup_box").show()
    $("#genotype_confirm_submit_btn").html('Proceed')
})







// *********** EDIT GENOTYPE **************//
$("#genotype_confirm_submit_btn").click(function(e){
    e.preventDefault()
    edit_genotype()
})


// ******* EDIT GENOTYPE ON ENTER **********//
$("#genotype_input").keypress(function(e){
    if(e.which == 13){
        e.preventDefault()
        edit_genotype()
    }
})



function edit_genotype(){
    $(".alert-form").html('')
    var genotype =$("#genotype_input").val()
    var genotype_id = $("#options_id_input").val()
    $("#genotype_confirm_submit_btn").html('Please wait...')

    if(validate_genotype(genotype)){
        $("#genotype_confirm_submit_btn").html('Proceed')
        return;
    }

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-edit-genotype') }}",
        method: "post",
        data: {
            genotype: genotype,
            genotype_id: genotype_id,
        },
        success: function (response){
            if(response.error){
                $(".genotype_0").html(response.error.genotype)
            }else if(response.data){
                $(genotype_parent).html(genotype.toUpperCase())
                $(".modal-alert-popup").hide()
                bottom_alert_success('Genotype has been updated!')
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




function validate_genotype(genotype){
    var state = false;
    if(genotype == ''){
        state = true;
        $(".genotype_0").html('*Genotype field is required')
    }else if(genotype.length > 5){
        state = true;
        $(".genotype_0").html('*Maximum of 5 characters')
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
var genotype_parent = null;
$(".genotype-delete-btn").click(function(e){
    e.preventDefault()
    var genotype = $(this).attr('data-name')
    var genotype_id =  $(this).attr('id')
   
    genotype_parent = $(this).parent().parent().parent().parent().parent()
    $("#options_delete_id_input").val(genotype_id)
    $("#delete_modal_popup_box").show()
    $("#delete_confirm_submit_btn").html('Proceed')
    apend_message("<p>Do you wish to delete the genotype <br><b>"+genotype+"</b></p>")
})








// *********** DELETE GENOTYPE **************//
$("#delete_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var genotype_id = $("#options_delete_id_input").val()
    $("#delete_confirm_submit_btn").html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-genotype') }}",
        method: "post",
        data: {
            genotype_id: genotype_id,
        },
        success: function (response){
            if(response.data){
                $(genotype_parent).remove()
                $(".modal-alert-popup").hide()
                bottom_alert_success('Genotype has been deleted!')
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







// **********ADD GENOTYPE MODAL OPEN *************//
$("#add_genotype_btn").click(function(e){
    e.preventDefault()
    $(".alert-form").html('')
    $("#add_genotype_modal_popup_box").show()
})


// ******* ADD GENOTYPE ON ENTER ************//
$("#add_genotype_input").keypress(function(e){
    if(e.which == 13){
        e.preventDefault()
        add_genotype()
    }
})



// ********** ADD GENOTYPE ***********//
$("#add_confirm_submit_btn").click(function(e){
    e.preventDefault()
    add_genotype()
})




function add_genotype(){
    $(".alert-form").html('')
    var genotype =$("#add_genotype_input").val()
    $("#add_confirm_submit_btn").html('Please wait...')

    if(validate_genotype(genotype)){
        $("#add_confirm_submit_btn").html('Proceed')
        return;
    }


    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-add-genotype') }}",
        method: "post",
        data: {
            genotype: genotype,
        },
        success: function (response){
            if(response.error){
                $(".genotype_0").html(response.error.genotype)
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
$(".genotype-confirm-box-open").click(function(e){
    e.preventDefault()
    featured = $(this).parent()
    var genotype = $(this).attr('data-name')
    var genotype_id =  $(this).attr('id')
   
    $("#feature_id_input").val(genotype_id)
    $("#feature_confirm_submit_btn").html('Proceed')
    $("#feature_modal_popup_box").show()
    if($(featured).hasClass('active')){
        apend_message("<p>Do you wish to unfeature the genotype <br><b>"+genotype+"</b></p>")  
    }else{
        apend_message("<p>Do you wish to feature the genotype <br><b>"+genotype+"</b></p>") 
    }
})





// *********** TOGGLE FEATURED GENOTYPE ************//
$("#feature_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var genotype_id = $("#feature_id_input").val()
    $("#feature_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-feature-genotype') }}",
        method: "post",
        data: {
            genotype_id: genotype_id,
        },
        success: function (response){
            if(response.featured){
                $(featured).addClass('active')
                bottom_alert_success('Genotype has been featured!')
            }else if(response.unfeatured){
                $(featured).removeClass('active')
                bottom_alert_success('Genotype has been unfeatured!')
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












