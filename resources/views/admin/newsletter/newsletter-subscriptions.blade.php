




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
                                <li class="breadcrumb-item"><a href="javascript: void()">Newsletter Subscriptions</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Newsletter subscriptions</h4>
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
                                        <a href="#" id="delete_newsletter_subs_btn" class="mini-btn bg-danger"><i class="fa fa-trash"></i></a>
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
                                                            <input type="checkbox" class="check-box-all" {{ Session::has('all') ? 'checked' : '' }}>
                                                    @endif
                                                    </th>
                                                    <th>Email</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="parent_table">
                                                @if(count($newsletters))
                                                @foreach($newsletters as $newsletter)
                                                <tr>
                                                    <td><input type="checkbox" id="{{ $newsletter->id }}" data-email="{{ $newsletter->email }}" class="news-letter-check-box" {{ news_subs($newsletter->id) ? 'checked' : '' }}></td>
                                                    <td>{{ $newsletter->email }}</td>
                                                    
                                                    <td>{{ date('d M Y', strtotime($newsletter->date)) }}</td>
                                                    <td>
                                                        <a href="#" id="{{ $newsletter->id }}" class="delete-news-letter"><i class="fa fa-trash text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div><!-- table end-->
                                    <div id="bottom_table_part">
                                        @if(!count($newsletters))
                                        <div class="text-center">There are no subscribers yet!</div>
                                        @endif
                                        @if(count($newsletters))
                                        <div class="paginate">{{ $newsletters->links("pagination::bootstrap-4") }}</div>
                                        @endif
                                    </div>
                                </div>
                               <div class="text-center"> <a href="{{ url('/admin/news-letter') }}" class="btn-default">Send Newsletter</a></div>
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
<section class="modal-alert-popup" id="delete_newesletter_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete this email?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button"  id="delete_newsletter_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->








<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="delete_newesletters_page_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to delete these emails?</p>
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

// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#parent_table").children()
    if(table.length == 0){
        $(".check-all-emails").html('')
        $("#bottom_table_part").html("<div class='text-center'>There are no subscribers yet!</div>")
    }
}







// *********** CHECK ALL NEWSLETTER EMAILS ************//
$("#parent_table_container").on('click', '.check-box-all', function(){
    if($(this).prop('checked'))
    {
        update_all_id(true)
        $(".news-letter-check-box").prop('checked', true)
    }else{
        update_all_id(false)
        $(".news-letter-check-box").prop('checked', false)
    }
})





function update_all_id(state)
{
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-all-newsletter-id') }}",
        method: "post",
        data: {
            state: state
        },
        success: function (response){
            $("#access_preloader_container").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}






// ************ OPEN CONFIRM MODAL **************//
var id = null;
var self_parent = null;
$("#parent_table_container").on('click', '.delete-news-letter', function(e){
    e.preventDefault()
    id =  $(this).attr('id')
   
    self_parent = $(this).parent().parent()
    $("#delete_newesletter_modal_popup_box").show()
    $("#delete_newsletter_confirm_submit_btn").html('Proceed')
})



// ************ DELETE NEWSLETTER EMAIL ***************//
$("#delete_newsletter_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html("Please wait...")
    

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-newsletter-subscription') }}",
        method: "post",
        data: {
            id: id,
        },
        success: function (response){
            if(response.data){
                $(self_parent).remove()
                table_check()
                bottom_alert_success('Newsletter subscription deleted successfully!')
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







// ************* CHECK/UNCHECK SINGLE EMAILS ***********//
var email = null;
$("#parent_table_container").on('click', '.news-letter-check-box', function(){
    id = $(this).attr('id')
    email = $(this).attr('data-email')
    if($(this).prop('checked'))
    {
        check_single_email(true)
    }else{
        check_single_email(false)
    }
    $(".check-box-all").prop('checked', false)
})




function check_single_email(state){

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-check-newsletter-email-single') }}",
        method: "post",
        data: {
            id: id,
            email: email,
            state: state
        },
        success: function (response){
            if(response.removed)
            {
                $(".check-box-all").prop('checked', false)
            }
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}







// *********** OPEN MASS DELETE MODAL **************//
$("#delete_newsletter_subs_btn").click(function(e){
    e.preventDefault()
    var is_checked = $('.news-letter-check-box')
    if($(is_checked).is(':checked'))
    {
        $("#delete_newesletters_page_popup_box").show()
        $("#delete_newsletters_btn_submit").html('Proceed')
    }else{
        bottom_alert_error('No row was selected for this action')
    }
})





// ************* DELETE CHECKED EMAILS ***********//
$("#delete_newsletters_btn_submit").click(function(e){
    e.preventDefault()
    $(this).html("Please wait...")

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-check-newsletter-mass-delete') }}",
        method: "post",
        data: {
            remove: 'remove'
        },
        success: function (response){
            if(response.error){
                bottom_alert_error('Network error, try again later!')
            }else{
                $("#parent_table_container").html(response)
                bottom_alert_success('Email subscription deleted successfully!')
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