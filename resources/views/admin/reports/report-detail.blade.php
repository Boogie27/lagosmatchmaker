


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
                                <li class="breadcrumb-item"><a href="{{ url('/admin/report') }}">Report</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">{{ ucfirst($reporter->user_name) }} Report</h4>
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
                            <div class="col-xl-12"><!-- profile detail left end-->
                                <div class="row">
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Reporter</h4> 
                                                <div class="text-right pb-3">
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li class="text-left">
                                                                <a href="mailto:{{ $reporter->email }}">Send message</a>
                                                            </li>
                                                            <li class="text-left">
                                                                <a href="#" data-name="{{ $reporter->user_name }}" id="{{ $reporter->report_id }}" class="delete-confirm-box-open">Delete report</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="ul-profile-detail">
                                                <li>Name: <span class="pl-2"> {{ $reporter->user_name }}</span></li>
                                                <li>Email: <span class="pl-2">{{ $reporter->email }}</span></li>
                                                <li>Date: <span class="pl-2">{{ date('d M Y', strtotime($reporter->date_reported)) }}</span></li>
                                            </ul>
                                        </div>
                                    </div><!-- report end-->
                                    <div class="col-xl-6"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header">
                                                <h4>Reported</h4> 
                                                <div class="text-right pb-3">
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                        <ul class="drop-down-body">
                                                            <li class="text-left">
                                                                <a href="mailto:{{ $reported->email }}">Send message</a>
                                                            </li>
                                                            <li class="text-left">
                                                                <a href="#" data-name="{{ $reporter->user_name }}" id="{{ $reporter->report_id }}" class="delete-confirm-box-open">Delete report</a>
                                                                @if(!$reported->is_suspend)
                                                                <a href="#" data-name="{{ $reported->user_name }}" id="{{ $reported->id }}" class="suspend-confirm-box-open">Suspend member</a>
                                                                @endif
                                                                @if(!$reported->is_deactivated)
                                                                <a href="#" data-name="{{ $reported->user_name }}" id="{{ $reported->id }}" class="deactivate-confirm-box-open">Deactivate member</a>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="ul-profile-detail">
                                                <li>Name: <span class="pl-3"> {{ $reported->user_name }}</span></li>
                                                <li>Email: <span class="pl-3">{{ $reported->email }}</span></li>
                                                <li>Date: <span class="pl-3">{{ date('d M Y', strtotime($reporter->date_reported)) }}</span></li>
                                            </ul>
                                        </div>
                                    </div><!-- report end-->
                                    <div class="col-xl-12"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header"><h4>Report</h4></div>
                                            <ul class="ul-profile-detail">
                                                <li>
                                                    <p class="detail-about-p">{{ $reporter->report }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- report end-->
                                    <div class="col-xl-12"><!-- report start-->
                                        <div class="profile-detail-left">
                                            <div class="title-header"><h4>Report counts</h4></div>
                                            <ul class="ul-profile-detail ul-report">
                                                <li>
                                                    <p class="detail-about-p">
                                                        Report count: <span class="pl-3"><span class="bg-warning badge" style="color: #fff;">{{ user_report_count($reported->id) }}</span></span>
                                                    </p>
                                                </li>
                                                @if(count($other_reports))
                                                <li class="other-reports">
                                                    Other reports: 
                                                    <div class="ul-other-reports">
                                                        @foreach($other_reports as $other_report)
                                                        <div class="child-report"><a href="{{ url('/admin/report-detail/'.$other_report->report_id) }}">{{ ucfirst($other_report->user_name) }}</a></div class="child-report">
                                                        @endforeach
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div><!-- report end-->
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









<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="deactivate_member_modal_popup_box">
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
                        <button type="button"  id="deactivate_user_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE MODAL ALERT END -->








<!--  DELETE MODAL ALERT START -->
<section class="modal-alert-popup" id="suspend_member_modal_popup_box">
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
                        <button type="button"  id="suspend_user_confirm_submit_btn" class="confirm-btn">Proceed</button>
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





// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#delete_modal_popup_box").find('.confirm-header').html(message)
    $("#deactivate_member_modal_popup_box").find('.confirm-header').html(message)
    $("#suspend_member_modal_popup_box").find('.confirm-header').html(message)
}









// ************ OPEN REPORT CONFIMR BOX *********//
var content = null
var report_id = null;

$(".delete-confirm-box-open").click(function(e){
    e.preventDefault()
    content = $(this).attr('data-name')
    report_id =  $(this).attr('id')
    
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
            content: content,
            report_page: true
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







// ************ OPEN REPORT CONFIMR BOX *********//
var content = null
var user_id = null;
var parent = null;

$(".deactivate-confirm-box-open").click(function(e){
    e.preventDefault()
    content = $(this).attr('data-name')
    user_id =  $(this).attr('id')
    parent = $(this)
    
    $("#deactivate_user_confirm_submit_btn").html('Proceed')
    $("#deactivate_member_modal_popup_box").show()
    apend_message("<p>Do you wish to deactivate <b>"+content+"</b>?</p>")  
})





// *********** DEACTIVATE MEMBER ************//
$("#deactivate_user_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#deactivate_user_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-deactivate-member') }}",
        method: "post",
        data: {
            user_id: user_id
        },
        success: function (response){
            if(response.deactivated){
               $(parent).remove()
               bottom_alert_success(content+' deactivated successfully!')
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







// ************ OPEN SUSPEND CONFIMR BOX *********//
$(".suspend-confirm-box-open").click(function(e){
    e.preventDefault()
    content = $(this).attr('data-name')
    user_id =  $(this).attr('id')
    parent = $(this)
    
    $("#suspend_user_confirm_submit_btn").html('Proceed')
    $("#suspend_member_modal_popup_box").show()
    apend_message("<p>Do you wish to suspend <b>"+content+"</b>?</p>")  
})








// *********** SUSPEND MEMBER ************//
$("#suspend_user_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#suspend_user_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-suspend-member') }}",
        method: "post",
        data: {
            user_id: user_id
        },
        success: function (response){
            if(response.suspended){
               $(parent).remove()
               bottom_alert_success(content+' has been suspended successfully!')
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