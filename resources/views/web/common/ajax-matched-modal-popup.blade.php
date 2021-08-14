

<div class="title-header text-center">
    <h4>You're Matched</h4>
    <p>You and {{ $display_name }} have both matched with each other</p>
    <ul class="ul-profile-match">
        <li class="profile-one">
        @php($my_name = user_detail()->display_name ? user_detail()->display_name : user_detail()->user_name)
            <ul class="profile-one-content">
                <li><h4>{{ ucfirst($my_name) }}</h4></li>
                <li><p>Age: {{ user_detail()->age ?? 'No age' }}</p></li>
                <li><p><i class="fa fa-map-marker-alt"></i> {{ user_detail()->location ?? 'No location' }}</p></li>
            </ul>
            <div class="profile-head-img"><h4>{{ user_detail()->gender == 'male' ? 'M' : 'F' }}</h4></div>
        </li>
        <li><i class="fa fa-heart"></i></li>
        <li class="profile-one">
            <div class="profile-head-img"><h4>{{ $user->gender == 'male' ? 'M' : 'F' }}</h4></div>
            <ul class="profile-two-content">
                <li><h4>{{ ucfirst($display_name) }}</h4></li>
                <li><p>Age: {{ $user->age ?? 'No age'}}</p></li>
                <li><p><i class="fa fa-map-marker-alt"></i> {{ $user->location ?? 'No location' }}</p></li>
            </ul>
        </li>
    </ul>
</div>
<div class="profile-match-body">
    <ul>
        <li><a href="{{ url('/chat/'.$user->id) }}" class="match-anchor-btn">Send a message</a></li>
        <li><a href="#" class="member_match_close_btn">Back to Profile</a></li>
    </ul>
</div>