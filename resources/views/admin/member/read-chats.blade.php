


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
                
                                    <div class="chat-frame-container" id="chat_frame_container">
                                        <div id="chat_loading_container" class="text-primary text-center mt-2" style="display: none;"><b>Loading...</b></div>
                                        <div class="main-chat-body flex"> <!-- chat start -->
                                        @if(count($chats))
                                            @foreach($chats as $chat)
                                                @if($chat->type == 'text')
                                                <ul class="ul-chat-body">
                                                    <li class="li-chat-body {{ $chat->sender_id == $user->id ? 'active' : '' }}">
                                                        <div class="chat-chat-body">
                                                            <div class="icon text-right">
                                                                <a href="#" id="{{ $chat->chat_id }}" class="delete-chat-btn"> <i class="fa fa-times"></i></a>
                                                            </div>
                                                            <p class="chat-paragraph">{{ $chat->chat}}</p>
                                                            <div class="time"><span>{{ chat_time($chat->time) }}</span></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                @endif
                                                @if($chat->type == 'image')
                                                <ul class="ul-chat-body"><!-- chat image start -->
                                                    <li class="li-chat-body image {{ $chat->sender_id == $user->id ? 'active' : '' }}">
                                                        <div class="chat-chat-body chat-image-body">
                                                            <div class="icon text-right">
                                                                <a href="#" id="{{ $chat->chat_id }}" class="delete-chat-btn"> <i class="fa fa-times"></i></a>
                                                            </div>
                                                            <div class="chat-image">
                                                                <img src="{{ asset($chat->chat) }}" alt="">
                                                                <div class="inner-icon">
                                                                    <a href="{{ url($chat->chat) }}" download>Download <i class="fa fa-arrow-down"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="time"><span>{{ chat_time($chat->time) }}</span></div>
                                                        </div>
                                                    </li>
                                                </ul><!-- chat image end -->
                                                @endif
                                            @endforeach
                                        @endif
                                        </div><!-- chat end -->
                                    </div>
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


// ************* KEEP CHAT AT THE BOTTOM ***********//
var innerItems = $(".main-chat-body").height()
// $("#chat_frame_container").scrollTop(innerItems)
$("#chat_frame_container").animate({
        scrollTop: 1000
})








// ************** DELETE CHAT ************//
var parent = null;
$("#chat_frame_container").on('click', '.delete-chat-btn', function(e){
    e.preventDefault()
    var chat_id = $(this).attr('id')
    parent = $(this).parent().parent().parent().parent()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-delete-user-chat') }}",
        method: "post",
        data: {
            chat_id: chat_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
            }
           console.log(response)
        }, 
        error: function(){
            console.log('something went wrong')
        }
    });
})









var active = false
var parentContainer = $(".chat-frame-container");
$(parentContainer).scroll(function(e){
    frameScroll = $(this).scrollTop();
    if(!active && frameScroll <= 0 ){
        active = true;
        get_infinte_chat()
    }
})









// ********** GET CHATS FOR INFINIT SCROLL *************//
var take = 50;
var remender = 0;
var reachedMax = false;
var user_id = "{{ $user->id }}"
var chat_token = "{{ $chat_token }}"

function get_infinte_chat(){
    if(!chat_token || reachedMax) return

    $("#chat_loading_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/admin/ajax-get-infinit-user-chat') }}",
        method: "post",
        data: {
            take: take,
            user_id: user_id,
            remender: remender,
            chat_token: chat_token
        },
        success: function (response){
            take += 25;
            active = false;
            $(".main-chat-body").prepend(response.data)
           if(response.remender)
            {
                remender = response.remender
            }else{
                reachedMax = true; 
                $("#chat_loading_container").html('There are no more messages')
                return $("#chat_loading_container").show()
            }
            $("#chat_loading_container").hide()
        }, 
        error: function(){
            $("#chat_loading_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}









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