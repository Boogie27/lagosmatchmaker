
@if($daily_matches)
<div class="title-header">
    <h3>Daily Request ( {{ $daily_matches->counter }} )</h3>
</div>
<div class="matches-request-container">
    <div class="row">
        @php($daily_requests = json_decode($daily_matches->match_id, true))
        @foreach($daily_requests as $daily_request)
            @php($user = get_user($daily_request['id']))
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="match-ipod"> <!-- match reqest start-->
                    <div class="match-img">
                        <a href="{{ url('/profile/'.$user->id) }}"> 
                           <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                        </a>
                        <ul>
                            <li> <a href="{{ url('/profile/'.$user->id) }}"> {{ $user->user_name }} </a></li>
                            <li class="level">{{ $user->membership_level}}</li>
                            <li class="date-added">Since {{ date('d M Y', strtotime($daily_request['time'])) }}</li>
                        </ul>
                    </div>
                    <div class="right-drop-down">
                        <div class="drop-down">
                            <i class="fa fa-ellipsis-h drop-down-btn"></i>
                            <ul class="drop-down-body">
                                <li>
                                    <a href="{{ url('/profile/'.$user->id) }}">View Detail</a>
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
    <div class="title-header">
        <h3>Daily Request ( 0 )</h3>
    </div>
    <div class="note-text">No Daily Match Request!</div>
@endif

