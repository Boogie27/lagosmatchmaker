<div class="profile-detail-left">
    <div class="title-header">
        <h4>Physical info</h4>
        @if(is_loggedin() && user('id') == $user->id)
        <a href="#" id="detail_physical_info_btn_open"><i class="fa fa-pen"></i></a>
        @endif
    </div>
    <ul class="ul-profile-detail" id="ul_phisical_info_body">
        <li>
            <div class="title">Height  </div>
            <div class="body">: {{ $user->height  ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Weight  </div>
            <div class="body">: {{ $user->weight ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Hair color  </div>
            <div class="body">: {{ $user->hair_color ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Eye color  </div>
            <div class="body">: {{ $user->eye_color ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Body type  </div>
            <div class="body">: {{ $user->body_type ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Ethnicity  </div>
            <div class="body">: {{ $user->ethnicity ?? 'Empty' }}</div>
        </li>
    </ul>
</div> <!-- profile detail left end-->


















<!-- LOOKING FOR SECTION -->
 <div class="profile-detail-left">
    <div class="title-header">
        <h4>Looking for</h4>
        @if(is_loggedin() && user('id') == $user->id)
        <a href="#" id="looking_for_btn_open"><i class="fa fa-pen"></i></a>
        @endif
    </div>
    <ul class="ul-profile-detail" id="ul_looking_for_body">
        <li>
            @if($user->looking_for_detail)
            <p class="detail-about-p"> {{ $user->looking_for_detail }}</p>
            @else
            <p class="detail-about-p">Describe the type of a person you are looking for</p>
            @endif
        </li>
    </ul>
</div>













<!-- ADMIN MEMBER DETAIL PHYSICAL-->
<div class="profile-detail-left">
    <div class="title-header">
        <h4>Physical info</h4>
        
        <a href="#" id="detail_physical_info_btn_open"><i class="fa fa-pen"></i></a>
    </div>
    <ul class="ul-profile-detail" id="ul_phisical_info_body">
        <li>
            <div class="title">Height  </div>
            <div class="body">: {{ $user->height  ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Weight  </div>
            <div class="body">: {{ $user->weight ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Hair color  </div>
            <div class="body">: {{ $user->hair_color ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Eye color  </div>
            <div class="body">: {{ $user->eye_color ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Body type  </div>
            <div class="body">: {{ $user->body_type ?? 'Empty' }}</div>
        </li>
        <li>
            <div class="title">Ethnicity  </div>
            <div class="body">: {{ $user->ethnicity ?? 'Empty' }}</div>
        </li>
    </ul>
</div>