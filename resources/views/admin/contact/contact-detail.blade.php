


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
                                <li class="breadcrumb-item"><a href="{{ url('/admin/contact') }}">Contacts</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">{{ ucfirst($contact->full_name) }} Message</h4>
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
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Contact</h4> 
                                        <div class="text-right pb-3">
                                            <div class="drop-down">
                                                <i class="fa fa-ellipsis-h drop-down-open"></i>
                                                <ul class="drop-down-body">
                                                    <li class="text-left">
                                                        <a href="#">Reply</a>
                                                    </li>
                                                    <li class="text-left">
                                                        <a href="#" data-name="{{ $contact->full_name }}" id="{{ $contact->id }}" class="delete-confirm-box-open">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="ul-profile-detail">
                                        <li>Name: <span class="pl-2">{{ $contact->full_name }}</span></li>
                                        <li>Email: <span class="pl-2">{{ $contact->email }}</span></li>
                                        <li>Date: <span class="pl-2">{{ date('d M Y', strtotime($contact->date)) }}</span></li>
                                    </ul>
                                </div>
                                <div class="profile-detail-left">
                                    <div class="title-header"><h4>Message</h4></div>
                                    <ul class="ul-profile-detail" id="ul_about_me_body">
                                        <li>
                                            <p class="detail-about-p">{{ $contact->comment }}</p>
                                        </li>
                                    </ul>
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
<section class="modal-alert-popup" id="contact_modal_popup_box">
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
                        <button type="button"  id="contact_confirm_submit_btn" class="confirm-btn">Proceed</button>
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









// ************ OPEN CONTACT CONFIMR BOX *********//
var content = null
var contact_id = null;
$(".delete-confirm-box-open").click(function(e){
    e.preventDefault()
    content = $(this).attr('data-name')
    contact_id =  $(this).attr('id')

    
    $("#contact_confirm_submit_btn").html('Proceed')
    $("#contact_modal_popup_box").show()
    apend_message("<p>Do you wish to delete <b>"+content+"</b> message?</p>")  
})





// *********** DELETE CONTACT ************//
$("#contact_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $("#contact_confirm_submit_btn").html('Please wait...')
    
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-contact-us-delete') }}",
        method: "post",
        data: {
            contact_id: contact_id,
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






// ********** CONFIRM MODAL MESSAGE***********//
function apend_message(message){
    $("#contact_modal_popup_box").find('.confirm-header').html(message)
}




// end of ready funciton
})

</script>


