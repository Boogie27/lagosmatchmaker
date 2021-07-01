


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
                                @if(count($messages))
                                    @foreach($messages as $message)
                                    @php($last_chat = last_chat($message->id))
                                    @php($unread_message = unread($message->id))
                                    @php($name = display_name($message->display_name, $message->user_name))
                                    <a href="{{ url('/chat/'.$message->id) }}"> <!-- chat message start -->
                                        <ul class="ul-chat-message">
                                            <li class="chat-profile-img">
                                            <h4>{{ $message->gender == 'male' ? 'M' : 'F' }}</h4>
                                            </li>
                                            <li class="chat-msg">
                                                <h5>{{ $name }} <span class="float-right">{{ chat_time($last_chat->time) }}</span></h5>
                                                <p>
                                                    {{ substr($last_chat->chat, 0, 30) }}
                                                    @if($unread_message)
                                                    <span class="float-right">{{ $unread_message }}</span>
                                                    @endif
                                                </p>
                                            </li>
                                        </ul>
                                    </a> <!-- chat message end -->
                                    @endforeach
                                @endif
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
                                        @php($active = $chat->sender_id == user('id') ? 'active' : '')
                                        @if($chat->type == 'text')
                                        <ul class="ul-chat-content"><!-- chat content start -->
                                            <li class="li-chat-content {{ $active }}">
                                                <div class="inner-chat-content">
                                                    <div class="chat-content-option">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                        <ul class="ul-option-body {{ $active }}">
                                                            <li><a href="#" id="{{ $chat->chat_id }}" class="delete-chat-btn">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $chat->chat }}</p>
                                                    <div class="time"><i class="fa fa-clock"></i> {{ chat_time($chat->time) }}</div>
                                                </div>
                                            </li>
                                        </ul><!-- chat content end -->
                                        @endif
                                        @if($chat->type == 'image')
                                        <ul class="ul-chat-content"><!-- chat content start -->
                                            <li class="li-chat-img-content {{ $active }}">
                                                <div>
                                                    <div class="chat-content-option">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                        <ul class="ul-option-body {{ $active }}">
                                                            <li><a href="#" id="{{ $chat->chat_id }}" class="delete-chat-btn">Delete</a></li>
                                                            <li><a href="{{ asset($chat->chat) }}" download>Download</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="chat-img">
                                                        <img src="{{ asset($chat->chat) }}" alt="">
                                                    </div>
                                                    <div class="time"><i class="fa fa-clock"></i>{{ chat_time($chat->time) }}</div>
                                                </div>
                                            </li>
                                        </ul><!-- chat content end -->
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
// var innerItems = $(".inner-chat-body").height()
// $("#right_chattig_window").scrollTop(innerItems)





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
            receiver_id: "{{ $receiver->id }}"
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
// $("#chating_input_box").keypress(function(e){
//     if(e.which == 13){
//         e.preventDefault();
//         send_chat()
//     }
// })

// *************** SEND CHAT THROUGHT BUTTN ***************//
$("#chatting_button_submit").click(function(e){
    e.preventDefault();
    send_chat()
})


function send_chat(){
    var chat = $("#chating_input_box").val();
   
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-send-user-text-chats') }}",
        method: "post",
        data: {
            chat: chat,
            receiver_id: "{{ $receiver->id }}"
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









// ************** DELETE CHAT ************//
var parent = null;
$("#right_chattig_window").on('click', '.delete-chat-btn', function(e){
    e.preventDefault()
    var chat_id = $(this).attr('id')
    parent = $(this).parent().parent().parent().parent().parent().parent()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-delete-user-text-chat') }}",
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












// end
})
</script>

