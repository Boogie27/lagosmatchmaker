


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
                                <li class="breadcrumb-item"><a href="#">Read Chats</a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Read {{ ucfirst($user->user_name) }} Chats</h4>
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
                            <div class="col-xl-12"><!-- chat end-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>{{ ucfirst($friend->user_name) }}</h4>
                                        <h4>{{ ucfirst($user->user_name) }}</h4> 
                                    </div>
                                    <div class="main-chat-body flex"> <!-- chat start -->
                                        <ul class="ul-chat-body">
                                            <li class="li-chat-body">
                                                <div class="chat-chat-body">
                                                    <div class="icon text-right">
                                                        <a href="#"> <i class="fa fa-times"></i></a>
                                                    </div>
                                                    <p class="chat-paragraph">hello how are you doing</p>
                                                    <div class="time"><span>2:30</span></div>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="ul-chat-body">
                                            <li class="li-chat-body active">
                                                <div class="chat-chat-body">
                                                    <div class="icon text-right">
                                                        <a href="#"> <i class="fa fa-times"></i></a>
                                                    </div>
                                                    <p class="chat-paragraph">hello  whats up how are you doing</p>
                                                    <div class="time"><span>2:30</span></div>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="ul-chat-body"><!-- chat image start -->
                                            <li class="li-chat-body active image">
                                                <div class="chat-chat-body chat-image-body">
                                                    <div class="icon text-right">
                                                        <a href="#"> <i class="fa fa-times"></i></a>
                                                    </div>
                                                    <div class="chat-image">
                                                        <img src="{{ asset('web/images/picture/1.jpg') }}" alt="">
                                                    </div>
                                                    <div class="time"><span>2:30</span></div>
                                                </div>
                                            </li>
                                        </ul><!-- chat image end -->
                                    </div><!-- chat end -->
                                </div>
                            </div> <!-- chat  end-->
                        </div>
                    </div>
                </div>
                <!-- PROFILE DETAILS END-->
            </div><!-- end Content-->
        </div>
    </div>
</section>































































<script>
$(document).ready(function(){









// *********** APPROVE USER MODAL OPEN **************//
var user_id
var self
$(".deatil-approve-confirm-box-open").click(function(e){
    e.preventDefault()
    self = $(this)
    user_id = $(this).attr('id')
    name = $(this).attr('data-name')

    $("#member_approve_modal_popup_box").show()
})



// ********** APPOVE USER ***************//
$("#member_approve_confirm_submit_btn").click(function(e){
    e.preventDefault()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-approve-member') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data){
                $(self).remove()
                bottom_alert_success('User has been approved!')
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




// end
})
</script>