


<!-- CHAT SECTION START-->
<section class="chat-section">
    <div class="chat-container">
        <div class="row">
            <div class="col-xl-4" id="chat_left_container"> <!-- chat left start -->
                <div class="chat-left-container">
                    <div class="title-header"><h4>Chats</h4></div>
                    <div class="chat-search">
                        <form action="" method="GET">
                            <div class="chat-search-body">
                                <button type="button"><i class="fa fa-search"></i></button>
                                <input type="text" name="seach" class="form-control search-input" value="" placeholder="Search users">
                            </div>
                        </form>
                        <div class="chat-message-body">
                            <div class="title-header"><h4>Messages</h4></div>
                            <div class="chat-message-content">
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                            <p>Hello how are you doing dear</p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">2</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">2</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">2</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">2</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">2</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">10</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">10</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                                <a href="#"> <!-- chat message start -->
                                    <ul class="ul-chat-message">
                                        <li class="chat-profile-img">
                                           <h4>M</h4>
                                        </li>
                                        <li class="chat-msg">
                                            <h5>James alfred <span class="float-right">02:30</span></h5>
                                           <p>Hello how are you doing dear <span class="float-right">2</span></p>
                                        </li>
                                    </ul>
                                </a> <!-- chat message end -->
                            </div>
                            <br>
                            <div class="chat-profile-img">
                                <ul class="ul-chat-profile-img">
                                    <li class="profile-img-img">
                                        <h4>M</h4>
                                       <!-- <a href="#"><img src="{{ asset('web/images/avatar/15.jpg') }}" alt=""></a> -->
                                    </li>
                                    <li class="chat-profile-right">
                                       <a href="#">
                                            <h5>Jessica James</h5>
                                            <p>Ikeja | Lagos</p>
                                       </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- chat left start -->
            <div class="col-xl-8"> <!-- chat right start -->
                <div class="chat-right-container">
                    <div class="chat-right-head"><!-- chat right header start -->
                        <div class="chat-head-left">
                            <ul>
                                <li><a href="{{ url('/messages') }}"><i class="fa fa-arrow-left"></i></a></li>
                                <li class="chat-profile-img {{ $receiver->is_active ? 'active' : '' }}">
                                    <h4>{{ $profile_image }}</h4>
                                </li>
                                <li><h5>{{ ucfirst($display_name) }}</h5></li>
                            </ul>
                        </div>
                        <div class="chat-head-right">
                            <ul>
                                <li><a href="#" id="video_call_open_btn"><i class="fa fa-video"></i></a></li>
                                <li><a href="{{ url('/profile/'.$receiver->id) }}"><i class="fa fa-info"></i></a></li>
                            </ul>
                        </div>
                    </div><!-- chat right header end -->
                    <div class="chating-body"><!-- chat body start -->
                        <div class="right-chattig" id="right_chattig_window">
                        <div class="inner-chat-body">
                        @if(count($chats))
                            @foreach($chats as $chat)
                                @if(user('id') != $chat->sender_id)
                                    @if($chat->type == 'text' && user('id') == $chat->receiver_id && !$chat->receiver_delete || user('id') == $chat->sender_id && !$chat->sender_delete)
                                        <ul class="ul-left-chatting"><!-- chat content start -->
                                            <li class="chatting-p">
                                                <div class="chat-option-p">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <ul class="ul-option-body">
                                                        <li><a href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <p>{{ $chat->chat }}</p>
                                                <span><i class="fa fa-clock"></i> 2:30</span>
                                            </li>
                                        </ul><!-- chat content end -->
                                    @endif
                                    @if($chat->type == 'image' && !$chat->receiver_delete)
                                    <ul class="ul-left-chatting"><!-- chat left image content start -->
                                        <li class="chatting-p-img">
                                            <div class="chat-option-p">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <ul class="ul-option-body chat-img-option">
                                                    <li><a href="{{ url($chat->chat) }}" download>Download</a></li>
                                                    <li><a href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                            <div class="chat-pic">
                                                <img src="{{ asset($chat->chat) }}" alt="">
                                            </div>
                                        </li>
                                        <li class="chat-time"><span><i class="fa fa-clock"></i> 2:30</span></li>
                                    </ul><!-- chat left image content left -->
                                    @endif
                                @else
                                    @if($chat->type == 'text' && user('id') == $chat->sender_id && !$chat->sender_delete || user('id') == $chat->receiver_id && !$chat->receiver_delete)
                                    <ul class="ul-right-chatting">
                                        <div class="parent">
                                            <li class="chatting-p">
                                                <div class="chat-option-p">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <ul class="ul-option-body">
                                                        <li><a href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <p>{{ $chat->chat }}</p>
                                                <span><i class="fa fa-clock"></i> 2:30</span>
                                            </li>
                                        </div>
                                    </ul> 
                                    @endif
                                    @if($chat->type == 'image' && user('id') == $chat->sender_id && !$chat->sender_delete || user('id') == $chat->receiver_id && !$chat->receiver_delete)
                                        <ul class="ul-right-chatting">
                                            <div class="parent">
                                                <li class="chatting-p-img">
                                                    <div class="chat-option-p">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                        <ul class="ul-option-body">
                                                            <li><a href="{{ url($chat->chat) }}" download>Download</a></li>
                                                            <li><a href="#">Delete</a></li>
                
                                                        </ul>
                                                    </div>
                                                    <div class="chat-pic">
                                                        <img src="{{ asset($chat->chat) }}" alt="">
                                                    </div>
                                                </li>
                                                <li class="chat-time"><span><i class="fa fa-clock"></i> 2:30</span></li>
                                            </div>
                                        </ul>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        </div>
                        </div>
                    </div><!-- chat body end -->
                    <div class="chat-right-form">
                        <form action="" method="POST">
                            <div class="chat-input">
                                <input type="text" id="chating_input_box" class="form-control" placeholder="Enter Message...">
                                <button type="button" id="chatting_button_submit"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                        <ul class="ul-chat-files">
                            <li><a href="#"><i class="fa fa-smile"></i></a></li>
                            <li><a href="#"><i class="fa fa-image"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- chat right start -->
        </div>
    </div>
</section>
<!-- CHAT SECTION END-->











<!-- VIDEO CALL START-->
<section id="video_call_section">
    <div class="video-call-main">
        <div class="video-call-dark-theme">
            <div class="video-call-container">
                <ul class="ul-video-call">
                    <li>
                        <img src="{{ asset('web/images/avatar/15.jpg') }}" alt="">
                    </li>
                    <li>
                        <h4>James Jessica <span class="text-success">Video Calling...</span></h4>
                    </li>
                    <li>
                        <div class="call-btn bg-danger">
                            <a href="#" id="video_call_close_btn"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="call-btn bg-success">
                            <a href="#"><i class="fa fa-video"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
     </div>
</section>
<!-- VIDEO CALL END-->












<!--**********************AJAX  USER DETAIL ******************-->
<a href="{{ current_url() }}" id="current_url_input" style="display: none;"></a>
<a href="#" data-id="{{ $receiver->id }}" data-email="{{ $receiver->email }}" id="user_id_input_box" style="display: none;"></a>









<!--********************** JQUERY SCRIPTING SECTION ******************-->

<script>
$(document).ready(function(){
// ********* OPEN VIDEO CALL **********//
$("#video_call_open_btn").click(function(e){
    e.preventDefault()
    $("#video_call_section").show()
})



// ********* CLOSE VIDEO CALL ***********//
$("#video_call_close_btn").click(function(e){
    e.preventDefault()
    $("#video_call_section").hide()
})




// ********* OPEN CHAT OPTION **********//
$(window).click(function(e){
    $('ul.ul-option-body').hide()
    if($(e.target).hasClass('fa fa-ellipsis-v') || $(e.target).hasClass('ul-option-body')){
        e.preventDefault()
        $(e.target).parent().children('ul.ul-option-body').toggle()
    }
})





// ************* KEEP CHAT AT THE BOTTOM ***********//
var innerItems = $(".inner-chat-body").height()
$("#right_chattig_window").scrollTop(innerItems)





// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}






// **************** GET CHAT *********************//
function get_chat()
{
    var receiver_id = $("#user_id_input_box").attr('data-id')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-user-chats') }}",
        method: "post",
        data: {
            receiver_id: receiver_id,
        },
        success: function (response){
           console.log(response)
        }, 
        error: function(){
            console.log('something went wrong')
        }
    });
}


// get_chat() // get user chats





// *************** SEND CHAT THROUGHT INPUT***************//
$("#chating_input_box").keypress(function(e){
    if(e.which == 13){
        e.preventDefault();
        // send_chat()
    }
})

// *************** SEND CHAT THROUGHT BUTTN ***************//
$("#chatting_button_submit").click(function(e){
    e.preventDefault();
    // send_chat()
})


function send_chat(){
    var chat = $("#chating_input_box").val();
    var receiver_id = $("#user_id_input_box").attr('data-id')
   
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-send-user-text-chats') }}",
        method: "post",
        data: {
            chat: chat,
            receiver_id: receiver_id
        },
        success: function (response){
        //    console.log(response)
        location.reload()
        }, 
        error: function(){
            console.log('something went wrong')
        }
    });
}



















// ************ CONNECT TO SERVER *************//
// let ip_address = '127.0.0.1';
// let server_port = '3000';
// let socket = io(ip_address+ ':' + server_port)

// socket.on('connection')





// $("#chatting_button_submit").click(function(e){
//     e.preventDefault();
//     var chat = $("#chating_input_box")
    
//     socket.emit('sendChat', chat.val())

//     $(chat).val('')
//     return 
// })




var conn = new WebSocket('ws://127.0.0.1:8000');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};





// end
})
</script>





















<div class="right-chattig" id="right_chattig_window">
    <div class="inner-chat-body">
        <ul class="ul-chat-content"><!-- chat content start -->
            <li class="li-chat-content">
                <div class="chat-content-option">
                    <i class="fa fa-ellipsis-v"></i>
                    <ul class="ul-option-body">
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Download</a></li>
                    </ul>
                </div>
                <p>hello how are you doing hello how are you doinghello how are you doing</p>
                <div class="time"><i class="fa fa-clock"></i> 2:30</div>
            </li>
        </ul><!-- chat content end -->
        <ul class="ul-chat-content"><!-- chat content start -->
            <li class="li-chat-content active">
                <div class="chat-content-option">
                    <i class="fa fa-ellipsis-v"></i>
                    <ul class="ul-option-body">
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Download</a></li>
                    </ul>
                </div>
                <p>hello how ahow are you doing</p>
                <div class="time"><i class="fa fa-clock"></i> 2:30</div>
            </li>
        </ul><!-- chat content end -->

        <ul class="ul-chat-content"><!-- chat content start -->
            <li class="li-chat-img-content">
                <div class="chat-content-option">
                    <i class="fa fa-ellipsis-v"></i>
                    <ul class="ul-option-body">
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Download</a></li>
                    </ul>
                </div>
                <div class="chat-img">
                    <img src="{{ asset('web/images/picture/1.jpg') }}" alt="">
                </div>
                <div class="time"><i class="fa fa-clock"></i> 2:30</div>
            </li>
        </ul><!-- chat content end -->

        <ul class="ul-chat-content"><!-- chat content start -->
            <li class="li-chat-img-content active">
                <div class="chat-content-option">
                    <i class="fa fa-ellipsis-v"></i>
                    <ul class="ul-option-body">
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Download</a></li>
                    </ul>
                </div>
                <div class="chat-img">
                    <img src="{{ asset('web/images/picture/2.jpg') }}" alt="">
                </div>
                <div class="time"><i class="fa fa-clock"></i> 2:30</div>
            </li>
        </ul><!-- chat content end -->
    </div>
</div>
