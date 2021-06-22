




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
                                <li class="breadcrumb-item"><a href="javascript: void()">Member</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void()">Report</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Reported Members</h4>
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
                               <div class="table-responsive"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Reporter</th>
                                                <th>Reported</th>
                                                <th>Seen</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if(count($users))
                                                @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        {{ ucfirst($user->user_name) }}
                                                    </td>
                                                    <td>
                                                       {{ get_reported_member($user->reported_id) }}
                                                    </td>
                                                    <td>
                                                        <div class="suspend {{ !$user->is_seen ? 'active' : ''}}">
                                                            <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->report_id }}" class="seen-confirm-box-open"></a>
                                                        </div>
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($user->date_reported)) }}</td>
                                                    <td>
                                                        <div class="drop-down">
                                                            <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                            <ul class="drop-down-body">
                                                                <li>
                                                                    <a href="{{ url('/admin/report-detail/'.$user->report_id) }}">Report detail</a>
                                                                    <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->report_id }}" class="delete-confirm-box-open">Delete</a>
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
                                    @if(!count($users))
                                    <div class="text-center">There are no reports yet!</div>
                                    @endif
                                    @if(count($users))
                                    <div class="paginate">{{ $users->links("pagination::bootstrap-4") }}</div>
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















<!--  SEEN MODAL ALERT START -->
<section class="modal-alert-popup" id="report_modal_popup_box">
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
                        <button type="button"  id="report_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  SEEN MODAL ALERT END -->












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
                        <button type="button"  id="delete_confirm_submit_btn" class="confirm-btn">Proceed</button>
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
// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}









// ************ OPEN REPORT CONFIRM BOX *********//
var is_seen = null;
var content = null
var report_id = null;
$(".seen-confirm-box-open").click(function(e){
    e.preventDefault()
    is_seen = $(this).parent()
    content = $(this).attr('data-name')
    report_id =  $(this).attr('id')

    if(!$(is_seen).hasClass('active')) return;
    
    $("#report_confirm_submit_btn").html('Proceed')
    $("#report_modal_popup_box").show()
    apend_message("<p>Mark <b>"+content+"</b> report as seen?</p>")  
})





// *********** SEEN REPORT ************//
$("#report_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#report_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-report-seen') }}",
        method: "post",
        data: {
            report_id: report_id,
        },
        success: function (response){
            if(response.data){
                $(is_seen).removeClass('active')
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






// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#report_modal_popup_box").find('.confirm-header').html(message)
    $("#delete_modal_popup_box").find('.confirm-header').html(message)
}









// ************ OPEN REPORT CONFIMR BOX *********//
var content = null
var report_id = null;
var parent_container = null;
$(".delete-confirm-box-open").click(function(e){
    e.preventDefault()
    content = $(this).attr('data-name')
    report_id =  $(this).attr('id')
    parent_container = $(this).parent().parent().parent().parent().parent()
    
    $("#delete_confirm_submit_btn").html('Proceed')
    $("#delete_modal_popup_box").show()
    apend_message("<p>Do you wish to delete <b>"+content+"</b> report?</p>")  
})





// *********** DELETE REPORT ************//
$("#delete_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#delete_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-report-delete') }}",
        method: "post",
        data: {
            report_id: report_id,
        },
        success: function (response){
            if(response.data){
               $(parent_container).remove()
               bottom_alert_success(content+' report deleted successfully!')
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








// end of ready funciton
})

</script>
































