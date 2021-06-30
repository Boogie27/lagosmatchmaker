




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
                        <h4 class="mb-1 mt-0">Manage Newsletter</h4>
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
                                <div class="table-top">
                                    <div class="table-top pb-2">
                                        <a href="#" id="delete_newsletter_mass_modal_btn" class="mini-btn bg-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                    <div class="table-top pb-2">
                                        <a href="{{ url('/admin/compose-newsletter') }}" class="mini-btn">Compose</a>
                                    </div>
                               </div>
                                <div class="parent-table-container" id="parent_table_container">
                                    <div class="table-responsive"> <!-- table start-->
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="check-all-emails">
                                                    @if(count($newsletters))
                                                            <input type="checkbox" class="check-box-all">
                                                    @endif
                                                    </th>
                                                    <th>Title</th>
                                                    <th>Newsletter</th>
                                                    <th></th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="parent_table">
                                                @if(count($newsletters))
                                                @foreach($newsletters as $newsletter)
                                                <tr>
                                                    <td><input type="checkbox" id="{{ $newsletter->id }}" class="news-letter-check-box"></td>
                                                    <td>{{ $newsletter->title }}</td>
                                                    <td>
                                                        {!! substr( $newsletter->newsletter, 0, 30) !!}
                                                    </td>
                                                    <td><a href="#" data-url="{{ url('/admin/send-newsletter') }}" id="{{ $newsletter->id }}" class="send-newsletter-modal-open mini-btn">Send</a></td>
                                                    <td>{{ date('d M Y', strtotime($newsletter->date)) }}</td>
                                                    <td>
                                                        <div class="drop-down">
                                                            <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                            <ul class="drop-down-body">
                                                                <li>
                                                                    <a href="{{ url('/admin/edit-newsletter/'.$newsletter->id) }}">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" id="{{ $newsletter->id }}" class="save-news-letter-btn">Save</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ url('/admin/newsletter-preview/'.$newsletter->id) }}">Preview</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" id="{{ $newsletter->id }}" class="delete-news-letter-modal-open">Delete</a>
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
                                        @if(!count($newsletters))
                                        <div class="text-center">There are no newsletters yet!</div>
                                        @endif
                                        @if(count($newsletters))
                                        <div class="paginate">{{ $newsletters->links("pagination::bootstrap-4") }}</div>
                                        @endif
                                    </div>
                                </div>
                                @if(count($newsletters))
                                <div class="table-bottom">
                                    <span>Total: {{ count($newsletters) }}</span>
                                    <span class="pl-3">Subscribers selected: {{ $subscribers }}</span>
                                </div>
                                @endif
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
























<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_newesletter_page_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this newsletter?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_newsletters_btn_submit" class="confirm-btn">Proceed</button>
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
//*****IMPORTANT NOTE********** */
// 'send newsletter' function is in the script file 



// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#parent_table").children()
    if(table.length == 0){
        $(".check-all-emails").html('')
        $("#bottom_table_part").html("<div class='text-center'>There are no newsletters yet!</div>")
    }
}








// ************ OPEN CONFIRM MODAL **************//
var id = null;
var self_parent = null;
$("#parent_table_container").on('click', '.delete-news-letter-modal-open', function(e){
    e.preventDefault()
    id =  $(this).attr('id')
   
    self_parent = $(this).parent().parent().parent().parent().parent()
    $("#delete_newesletter_page_popup_box").show()
    $("#delete_newsletters_btn_submit").html('Proceed')
})







// ************ DELETE NEWSLETTER ***************//
$("#delete_newsletters_btn_submit").click(function(e){
    e.preventDefault()
    $(this).html("Please wait...")
    

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-news-letter') }}",
        method: "post",
        data: {
            id: id,
        },
        success: function (response){
            if(response.data){
                $(self_parent).remove()
                table_check()
                bottom_alert_success('Newsletter deleted successfully!')
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







// ************* CHECK/UNCHECK SINGLE NEWSLETTER ***********//
$("#parent_table_container").on('click', '.news-letter-check-box', function(){
    id = $(this).attr('id')

    if($(this).prop('checked'))
    {
        check_single(id, true)
    }else{
        check_single(id, false)
    }
    $(".check-box-all").prop('checked', false)
})




var stored_id = []
function check_single(id, data)
{
    if(stored_id.includes(id))
    {
        for(var i = 0; i < stored_id.length; i++){
            if(data == false && stored_id[i] == id){
                stored_id.splice(i, 1)
            }
        }
    }else{
        stored_id.push(id)
    }
}







// *********** OPEN MASS DELETE MODAL **************//
$("#delete_newsletter_mass_modal_btn").click(function(e){
    e.preventDefault()
    var is_checked = $('.news-letter-check-box')
    if($(is_checked).is(':checked'))
    {
        $("#delete_newesletters_modal_popup_box").show()
        $("#delete_newsletters_confirm_submit_btn").html('Proceed')
    }else{
        bottom_alert_error('No row was selected for this action')
    }
})





// ************* MASS DELETE CHECKED NEWSLETTERS ***********//
$("#delete_newsletters_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html("Please wait...")

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-newsletter-mass-delete') }}",
        method: "post",
        data: {
            stored_id: stored_id,
            newsletter: true
        },
        success: function (response){
            if(response.error){
                bottom_alert_error('Network error, try again later!')
            }else{
                $("#parent_table_container").html(response)
                bottom_alert_success('Newsletter deleted successfully!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})














// *********** CHECK ALL NEWSLETTER EMAILS ************//
$("#parent_table_container").on('click', '.check-box-all', function(){
    if($(this).prop('checked'))
    {
        check_all(true)
        $(".news-letter-check-box").prop('checked', true)
    }else{
        check_all(false)
        $(".news-letter-check-box").prop('checked', false)
    }
})




function check_all(data)
{
    var checkbox = $(".news-letter-check-box")
    $.each(checkbox, function(index, current){
        var id = $(current).attr('id')
        check_single(id, data)
    })
}








// ************  SAVE NEWSLETTER ****************//
$("#parent_table_container").on('click', '.save-news-letter-btn', function(e){
    e.preventDefault()
    var id = $(this).attr('id')
    $("#access_preloader_container").show()
    self_parent = $(this).parent().parent().parent().parent().parent()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-save-newsletter') }}",
        method: "post",
        data: {
            id: id
        },
        success: function (response){
            if(response.error){
                bottom_alert_error('Network error, try again later!')
            }else{
                $(self_parent).remove()
                table_check()
                bottom_alert_success('Newsletter saved successfully!')
            }
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})













// 'send newsletter' function is in the script file 

// end
})
</script>









