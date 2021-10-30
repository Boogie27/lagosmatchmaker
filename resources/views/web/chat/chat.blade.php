@php($user_detail = user_detail())


<!-- CHAT SECTION START-->
<section class="chat-section">
    <div class="chat-container">
        <div class="row">
            <div class="col-xl-4" id="chat_left_container"> <!-- chat left start -->
                <div class="chat-left-container">
                    <div class="title-header"><h4>Chats</h4></div>
                    <div class="chat-search">
                        <!-- <form action="" method="GET">
                            <div class="chat-search-body">
                                <button type="button"><i class="fa fa-search"></i></button>
                                <input type="text" name="seach" class="form-control search-input" value="" placeholder="Search users">
                            </div>
                        </form> -->
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
                                            <li class="chat-profile-img {{ $message->is_active ? 'active' : '' }}">
                                                @if(!is_loggedin() || !is_matched($message->id))
                                                <h4>{{  gender($message->gender) }}</h4>
                                                @endif
                                                @if(is_loggedin() && is_matched($message->id) && $message->avatar)
                                                <img src="{{ asset($message->avatar) }}" alt="">
                                                @endif
                                                @if(is_loggedin() && is_matched($message->id) && !$message->avatar)
                                                <img src="{{ asset(avatar($message->gender)) }}" alt="">
                                                @endif
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
                                        @if(is_loggedin() && $user_detail->avatar)
                                        <img src="{{ asset($user_detail->avatar) }}" alt="">
                                        @else
                                        <h4>{{ gender($user_detail->gender) }}</h4>
                                        @endif
                                    </li>
                                    <li class="chat-profile-right">
                                       <a href="#">
                                            @php($name = display_name($user_detail->display, $user_detail->user_name))
                                            <h5>{{ $name }}</h5>
                                            <p>Location: {{ $user_detail->location }}</p>
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
                                    @if(!is_loggedin() || !is_matched($receiver->id))   
                                    <h4>{{ $profile_image }}</h4>
                                    @endif
                                    @if(is_loggedin() && is_matched($receiver->id) && $receiver->avatar)
                                    <img src="{{ asset($receiver->avatar) }}" alt="">
                                    @endif
                                    @if(is_loggedin() && is_matched($receiver->id) && !$receiver->avatar)
                                    <img src="{{ asset(avatar($receiver->gender)) }}" alt="">
                                    @endif
                                </li>
                                <li><h5>{{ ucfirst($display_name) }}</h5></li>
                            </ul>
                        </div>
                        <div class="chat-head-right">
                            <ul>
                                <!-- <li><a href="#" id="video_call_open_btn"><i class="fa fa-video"></i></a></li> -->
                                <li><a href="{{ url('/profile/'.$receiver->id) }}"><i class="fa fa-info"></i></a></li>
                                <li><a href="#" id="refresh_chat_btn" class="refresh-btn">Refresh</a></li>
                            </ul>
                        </div>
                    </div><!-- chat right header end -->
                    <div class="chating-body"><!-- chat body start -->
                        <div class="right-chattig" id="right_chattig_window">
                            <div id="chat_loading_container" class="text-center mt-2" style="display: none;"><b>Loading...</b></div>
                            <div class="inner-chat-body">
                                <!-- ajax chat goes in here -->
                            </div>
                        </div>
                    </div><!-- chat body end -->
                    <div class="chat-right-form">
                        @if(!is_blocked($user_detail->id, $receiver->id))
                        <form action="" method="POST">
                            <div class="chat-input">
                                <input type="file" id="upload_chat_image_input" style="display: none;">
                                <input type="text" id="chating_input_box" class="form-control" placeholder="Enter Message...">
                                <button type="button" id="chatting_button_submit">
                                    <i class="fa fa-paper-plane"></i>
                                    <!-- <div class="chat-loader"></div> -->
                                </button>
                            </div>
                        </form>
                        <ul class="ul-chat-files">
                            <!-- <li><a href="#"><i class="fa fa-smile"></i></a></li> -->
                            <li><a href="#" id="upload_chat_image_btn"><i class="fa fa-image"></i></a></li>
                        </ul>
                        @else
                        <div class="blocked-alert">
                            <p class="text-danger">You have been blocked and can't message {{ $receiver->user_name }}</p>
                        </div>
                        @endif
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


var skip = 8
var take = 8;
var max = false;
var remender = 0;
var active = false
var is_sending = false
var user_id = "{{ $receiver->id }}"
var chat_token = "{{ $chat_token }}"


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
function chat_to_bottom(){
    var innerItems = $(".inner-chat-body")
    $("#right_chattig_window").scrollTop({
        scrollTop: 0
    })
}
// chat_to_bottom()


$("#right_chattig_window").scroll(function(e){
    var innerItems = $(".inner-chat-body")
    var scroll = $(this).scrollTop()
    console.log($(this).height())
})
// 825.609







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
    take = 8
    skip = 8
    var receiver_id = $("#user_id_input_box").attr('data-id')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-user-chats') }}",
        method: "post",
        data: {
            take: take,
            receiver_id: "{{ $receiver->id }}"
        },
        success: function (response){
            if(response.error){
                bottom_alert_error('Network error, try again later!')
            }else{
                skip += take
                max = false;
                active = false
                remender = response.remender;
                $(".inner-chat-body").html(response.data)
           }
           console.log(response, skip)
           is_sending = false
           $("#chatting_button_submit").html('<i class="fa fa-paper-plane"></i>')
        }, 
        error: function(){
            is_sending = false
            bottom_alert_error('Network error, try again later!')
            $("#chatting_button_submit").html('<i class="fa fa-paper-plane"></i>')
        }
    });
}









// *************** SEND CHAT THROUGHT ENTER BUTTON ***************//
$("#chating_input_box").keypress(function(e){
    if(e.which == 13)
    {
        e.preventDefault();
        send_chat()
    }
})

// *************** SEND CHAT THROUGHT BUTTON ***************//
$("#chatting_button_submit").click(function(e){
    e.preventDefault();
    send_chat()
})


function send_chat(){
    var chat = $("#chating_input_box").val();
    if(chat.length <= 0){
        return bottom_alert_error('Chat can not be empty!')
    }

    if(is_sending) return
    if(!is_sending){
        is_sending = true;
    }

    $("#chatting_button_submit").html('<div class="chat-loader"></div>')
    
   
   
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-send-user-text-chats') }}",
        method: "post",
        data: {
            chat: chat,
            receiver_id: "{{ $receiver->id }}"
        },
        success: function (response){
            get_chat()
            $("#chating_input_box").val('')
        }, 
        error: function(){
            is_sending = false;
            $("#chatting_button_submit").html('<i class="fa fa-paper-plane"></i>')
            bottom_alert_error('Network error, try again later!')
        }
    });
}











// ********** OPEN UPLOAD IMAGE INPUT ************//
$("#upload_chat_image_btn").click(function(e){
    e.preventDefault()
    $("#upload_chat_image_input").val('')
    $("#upload_chat_image_input").click()
})






// ********** UPLOAD  IMAGE **************//
$("#upload_chat_image_input").change(function(e){
    e.preventDefault()
   
    var receiver_id = "{{ $receiver->id }}";
	var image = $("#upload_chat_image_input");
    $("#access_preloader_container").show()

    if(validate_image(e))
    {
        return bottom_alert_error('Image type must be jpg, jpeg, png!')
    }
    
    csrf_token() //csrf token

	var data = new FormData();
	var image = $(image)[0].files[0];

    data.append('image', image);
    data.append('receiver_id', receiver_id);

	$.ajax({
        url: "{{ url('/ajax-upload-chat-image') }}",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response){
            if(response.error){
                bottom_alert_error(response.error.image)
            }else if(!response.data_error){
                get_chat()
            }
           $("#access_preloader_container").hide()
		},
		error: function(){
            $("#access_preloader_container").hide()
            bottom_alert_error('Network error, try again later!')
		}
    });
})






 
function validate_image(e){
    var state = false;
    var file = e.target.files
    var extension = file[0].type;
    
    if(extension != 'image/jpeg'){
        state = true;
        $("#profile_image_input").val('')
        $("#access_preloader_container").hide()
    }
    return state;
}









// ************** DELETE CHAT ************//
var parent = null;
$("#right_chattig_window").on('click', '.delete-chat-btn', function(e){
    e.preventDefault()
    var chat_id = $(this).attr('id')
    parent = $(this).parent().parent().parent().parent().parent().parent()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-delete-user-chat') }}",
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













// ********** INFINIT SCROLL EFFECT *********//

var parentContainer = $("#right_chattig_window");
$(parentContainer).scroll(function(e){
    frameScroll = $(this).scrollTop();
    var container = $(".right-chattig").height()
    if(!active && frameScroll == 0 ){
        active = true;
        get_infinte_chat()
    }
})











// ********** GET CHATS FOR INFINIT SCROLL *************//
function get_infinte_chat(){
    
    if(!chat_token || max) return

    $("#chat_loading_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-infinit-user-chat') }}",
        method: "post",
        data: {
            skip: skip,
            take: take,
            remender: remender,
            user_id: user_id,
            chat_token: chat_token
        },
        success: function (response){
            if(response.max){
                max = true;
                active = true;
                remender = response.remender
                $(".inner-chat-body").prepend(response.data)
            }else if(response.data){
                skip += take
                active = false;
                remender = response.remender
                $(".inner-chat-body").prepend(response.data)
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $("#chat_loading_container").hide()
            console.log(response, skip)
        }, 
        error: function(){
            $("#chat_loading_container").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
}


get_infinte_chat()









// ********** REFRESH CHAT **************//
$("#refresh_chat_btn").click(function(e){
    e.preventDefault()

    return get_chat()
})




// end
})
</script>

