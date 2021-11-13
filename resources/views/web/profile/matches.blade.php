<div class="title-header">
    <h3>My Matches ( <span>{{ count($friends) }}</span> )</h3>
    <p>Members who you have matched with</p>
</div>
@if(count($friends))
<div class="matches-request-container">
    <div class="row">
        @foreach($friends as $friend)
        @php($user = get_friends(user('id'), $friend))
        @php($image =  gender($user->gender))
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="match-ipod"> <!-- match reqest start-->
                <div class="match-img">
                    <a href="{{ url('/profile/'.$user->id) }}"> 
                            @if(!is_loggedin() || !is_matched($user->id))
                            <div class="img-letter {{ $user->is_active ? 'active' : '' }}"><h4>{{ $image }}</h4></div>
                            @endif
                            @if(is_loggedin() && is_matched($user->id) && $user->avatar)
                            <img src="{{ asset($user->avatar) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                            @endif
                            @if(is_loggedin() && is_matched($user->id) && !$user->avatar)
                            <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                            @endif
                       
                        <!-- <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active && 'active' }}"> -->
                    </a>
                    <ul>
                        <li> <a href="{{ url('/profile/'.$user->id) }}"> {{ $user->user_name }} </a></li>
                        <li class="level">{{ $user->membership_level}}</li>
                        <li class="date-added">Since {{ date('d M Y', strtotime($friend->like_date)) }}</li>
                    </ul>
                </div>
                <div class="right-drop-down">
                    <div class="drop-down">
                        <i class="fa fa-ellipsis-h drop-down-btn"></i>
                        <ul class="drop-down-body">
                            <li>
                                <a href="{{ url('/chat/'.$user->id) }}">Chat</a>
                            </li>
                            <li>
                                <a href="{{ url('/profile/'.$user->id) }}">View Detail</a>
                            </li>
                            <li>
                                <a href="#" data-name="{{ $user->user_name }}" id="{{ $friend->like_id }}" class="unmatch-user-button">Unmatch Member</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- match reqest end-->
        </div>
        @endforeach
    </div>
</div>
@else
    <div class="note-text">You have no matches!</div>
@endif

