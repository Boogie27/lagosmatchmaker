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
                        <div class="time"><i class="fa fa-clock"></i> {{ chat_time($chat->time) }}</div>
                    </div>
                </li>
            </ul><!-- chat content end -->
            @endif
        
        @endforeach
    @endif
</div>