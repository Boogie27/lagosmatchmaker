<h4>You're Matched</h4>
<p>You and {{ $display_name }} have both liked each other</p>
<ul class="ul-profile-match">
    <li class="profile-one">
        @php($my_image =  avatar(user_detail()->display_image, user_detail()->gender))
        @php($my_name = user_detail()->display_name ? user_detail()->display_name : user_detail()->user_name)
        <ul class="profile-one-content">
            <li><h4>{{ ucfirst($my_name) }}</h4></li>
            <li><p>Age: {{ user_detail()->age ?? 'No age' }}</p></li>
            <li><p><i class="fa fa-map-marker-alt"></i> {{ user_detail()->location ?? 'No location' }}</p></li>
        </ul>
        <img src="{{ asset($my_image) }}" alt="{{ $my_name }}">
    </li>
    <li class="match-heart-icon"><i class="fa fa-heart"></i></li>
    <li class="profile-one">
        <img src="{{ asset($profile_image) }}" alt="{{ $display_name }}">
        <ul class="profile-two-content">
            <li><h4>{{ ucfirst($display_name) }}</h4></li>
            <li><p>Age: {{ $user->age ?? 'No age'}}</p></li>
            <li><p><i class="fa fa-map-marker-alt"></i> {{ $user->location ?? 'No location' }}</p></li>
        </ul>
    </li>
</ul>