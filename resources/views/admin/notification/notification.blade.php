




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
                                <li class="breadcrumb-item"><a href="javascript: void()">Notification</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Notifictaion</h4>
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
                        <div class="notification-container">
                            <div class="notification-body" id="notification_body">
                                @if(count($notifications))
                                <div class="text-right clear-nots">
                                    <a href="#" class="admin-clear-all-notification">Clear All</a>
                                </div>
                                @endif
                                @if(count($notifications))
                                @foreach($notifications as $notification)
                                    <ul class="ul-notification {{ !$notification->is_seen ? 'active' : '' }}">
                                        <li class="notification-drop-down">
                                            <div class="drop-down">
                                                <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                <ul class="drop-down-body">
                                                    <li class="text-left">
                                                        @if(!$notification->is_seen)
                                                        <a href="#" id="{{ $notification->not_id}}" class="admin_user_notifiction_seen">Mark as seen</a>
                                                        @endif
                                                        <a href="#" id="{{ $notification->not_id}}" class="delete_admin_user_notification">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><b><a href="{{ url($notification->link ? $notification->link : '#') }}">{{ ucfirst($notification->title) }}</a></b></li>
                                        <li class="nots-items">
                                            <p><a href="{{ url($notification->link ? $notification->link : '#') }}">{{ $notification->description }}</a></p>
                                            <span class="date">{{ date('d M Y', strtotime($notification->date_sent)) }}</span>
                                        </li>
                                    </ul>
                                @endforeach
                                @else
                                 <div class="text-center pt-3">There are no notifications yet!</div>
                                @endif
                                @if(count($notifications))
                                <div class="paginate pt-3">{{ $notifications->links("pagination::bootstrap-4") }}</div>
                                @endif
                            </div>
                           
                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->


















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
// ********** DELETE NOTIFICATION ************//
var notification_id = null;
var not_parent = null;
$(".delete_admin_user_notification").click(function(e){
   e.preventDefault()
   notification_id = $(this).attr('id')
   $("#access_preloader_container").show()
   not_parent = $(this).parent().parent().parent().parent().parent()
   
   csrf_token() //csrf token

$.ajax({
    url: "{{ url('/admin/ajax-delete-notification') }}",
    method: "post",
    data: {
        notification_id: notification_id,
    },
    success: function (response){
        if(response.data){
           $(not_parent).remove()
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







// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}








// ********** DELETE NOTIFICATION ************//
var notification_id = null;
var not_parent = null;
var self = null
$(".admin_user_notifiction_seen").click(function(e){
   e.preventDefault()
   self = $(this)
   notification_id = $(this).attr('id')
   $("#access_preloader_container").show()
   not_parent = $(this).parent().parent().parent().parent().parent()
   
   csrf_token() //csrf token

$.ajax({
    url: "{{ url('/admin/ajax-seen-notification') }}",
    method: "post",
    data: {
        notification_id: notification_id,
    },
    success: function (response){
        if(response.data){
            $(self).remove()
            $(not_parent).removeClass('active')
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




// end
})
</script>


































































