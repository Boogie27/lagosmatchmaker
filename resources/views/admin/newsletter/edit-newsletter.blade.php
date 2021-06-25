
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
                                <li class="breadcrumb-item"><a href="javascript: void()">Newsletter</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Edit Newsletter</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-right pb-3">
                                    <div class="drop-down">
                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                        <ul class="drop-down-body">
                                            <li class="text-left">
                                                <a href="#" class="">Send</a>
                                                <a href="#" class="">Preview</a>
                                                <a href="#" id="{{ $newsletter->id }}" class="delete_newsletter_modal_open" class="">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                               <div class="">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                    <form action="{{ url('/admin/edit-newsletter/'.$newsletter->id) }}" method="POST" class="parsley-examples">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="userName">Title<span class="text-danger">*</span></label>
                                                    <input type="text" name="title" parsley-trigger="change" placeholder="Enter title" class="form-control" value="{{ $newsletter->title ?? old('title') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('title')) {{ $errors->first('title') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="emailAddress">Newsletter<span class="text-danger">*</span></label>
                                                    <div id="summernote-editor">
                                                        {!! $newsletter->newsletter !!} 
                                                    </div> <!-- end summernote-editor-->
                                                    <textarea name="newsletter" id="newsletter_form_input" style="display: none;"></textarea>
                                                    <div class="alert-form text-danger">@if($errors->first('newsletter')) {{ $errors->first('newsletter') }} @endif</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group text-right mb-3">
                                                    <div class="form-group">
                                                        <button type="submit" id="admin_update_submit" class="btn-fill-block">Update Newsletter</button>
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













<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_newesletters_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete these newsletter?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_newsletters_confirm_submit_btn" class="confirm-btn">Proceed</button>
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
// *********** UPDATE BUTTON *********//
$("#admin_update_submit").click(function(e){
    $(this).html('Please wait...')
    var inner_content = $(".note-editable").html()
    $("#newsletter_form_input").val(inner_content)
})








// ************* DELETE NEWSLETTER ************//
var id
$(".delete_newsletter_modal_open").click(function(e){
    e.preventDefault()
    id = $(this).attr('id')
    $("#delete_newesletters_modal_popup_box").show()
})







// ************ DELETE NEWSLETTER ***************//
$("#delete_newsletters_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html("Please wait...")
    

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-news-letter') }}",
        method: "post",
        data: {
            id: id,
            edit: true
        },
        success: function (response){
            if(response.data){
                location.assign(response.data)
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




// end of ready function
})
</script>












