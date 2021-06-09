<!-- MESSAGES HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your messages</h4>
            <p> <a href="{{ url('/') }}">Home</a> - messages</p>
        </div>
        <div class="message-form">
            <form action="" method="GET">
                <input type="text" class="form-control" placeholder="Search messages">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->








<!-- MESSAGE SECTION START-->
<section class="message-section-chart">
    <div class="profile-detail-container">
        <div class="message-content ul_message_container"><!-- message content start -->
            @if(count($messages))
                @foreach($messages as $message)
                    @php($last_chat = last_chat($message->id))
                    @php($unread_message = unread($message->id))
                    @php($image =  avatar($message->display_image, $message->gender))
                    <div class="message-inner-content">
                        <div class="message-img">
                            <a href="{{ url('/chat/'.$message->id) }}">
                                <i class="fa fa-circle {{ $message->is_active ? 'active' : '' }}"></i>   
                                <img src="{{ asset($image) }}" alt="{{ $message->user_name }}">
                            </a>
                        </div>
                        <ul class="ul-message">
                            <li>
                                <h5>
                                    <a href="{{ url('/chat/'.$message->id) }}"> {{ display_name($message->display_name, $message->user_name) }}  </a>  
                                    <span class="badge bg-success" style="color: #fff; display: {{ $unread_message ? 'inline-block' : 'none' }}">{{ $unread_message }}</span>
                                    <div class="notification-drop-down">
                                        <i class="fa fa-ellipsis-h drop-down-btn notification-icon"></i>
                                        <ul class="drop-down-body ul-notification-body">
                                            <li><a href="#" id="{{ $message->id }}" class="confirm_modal_popup_btn">Delete</a></li>
                                            <li><a href="#">mark as seen</a></li>
                                        </ul>
                                    </div>
                                </h5>
                            </li>
                            <li>
                                <p>
                                <a href="{{ url('/chat/'.$message->id) }}" class="{{ !$last_chat->is_seen && user('id') != $last_chat->sender_id  ? 'unread-message' : '' }}"> {{ substr($last_chat->chat, 0, 40) }} </a>
                                <span class="float-right">{{ chat_time($last_chat->time) }}</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                @endforeach
            @else
            <div class="empty-page">
                <p>There are no messages yet!</p>
            </div>
            @endif
        </div><!-- message content end -->








            @if(count($may_likes))
            <div class="disable"> <!-- profile detail right start-->
                <div class="message-header title-header text-center">
                    <h4>You May Like</h4>
                    <p> Available lagosmatchmakers members you may also like</p>
                </div>
                <div class="you-may-like"><!-- you may like start-->
                    <div class="title-header"><h4>You May Like <span class="float-right"><a href="#" data-modal="#member_search_form_modal"><i class="fa fa-search"></i> Search</a></span></h4></div>
                    <div class="you-may-like-body">
                        @foreach($may_likes as $may_like)
                        @php($image =  avatar($may_like->display_image, $may_like->gender))
                        <div class="like-content">
                            <a href="{{ url('/profile/'.$may_like->id) }}">
                                <img src="{{ asset($image) }}" alt="{{ $may_like->user_name }}">
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('/profile/'.$may_like->id) }}">
                                    {{ display_name($may_like->display_name, $may_like->user_name) }}    
                                    </a>
                                </li>
                                <li><p>{{ ucfirst($may_like->membership_level) }}</p></li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div><!-- you may like end-->
            </div><!-- profile detail right end-->
            @endif
    </div>
</section>
<!-- MESSAGE SECTION END-->









<!-- CONFIRM ALERT START -->
<section class="modal-alert-popup" id="confirm_modal_popup_container">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you want to delete this message</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="login_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONFIRM ALERT END -->



@include('web.message.member-search-modal-popup')








<script>
$(document).ready(function(){
// ***************** OPEN MESSAGE DELETE MODAL *************//
$(".ul_message_container").on('click', '.confirm_modal_popup_btn', function(e){
     e.preventDefault()

     console.log('es')
})









// end
})
</script>



