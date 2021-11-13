<div class="title-header">
    <h3>Match Request ( <span>{{ count( $friends_request) }}</span> )</h3>
    <p>Members who would love to match with you</p>
</div>
@if(count($friends_request))
<div class="matches-request-container">
    <div class="row">
        @foreach($friends_request as $user)
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
                       
                        <!-- <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}"> -->
                    </a>
                    <ul>
                        <li> <a href="{{ url('/profile/'.$user->id) }}"> {{ $user->user_name }} </a></li>
                        <li class="level">{{ $user->membership_level}}</li>
                        <li class="date-added">Since {{ date('d M Y', strtotime($user->like_date)) }}</li>
                    </ul>
                </div>
                <div class="right-drop-down">
                    <div class="drop-down">
                        <i class="fa fa-ellipsis-h drop-down-btn"></i>
                        <ul class="drop-down-body">
                            <li>
                                <a href="{{ url('/profile/'.$user->id) }}">View Detail</a>
                            </li>
                            <li>
                                <a href="#" id="{{ $user->id }}" data-name="{{ $user->user_name }}" class="accept-friend-request-btn">Accept Request</a>
                            </li>
                            <li>
                                <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->like_id }}" class="cancel-user-request-button">Cancel Request</a>
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
    <div class="note-text">You have no match requests!</div>
@endif

