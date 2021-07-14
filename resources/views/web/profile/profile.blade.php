<!-- PROFILE START-->
<section class="profile-section">
    <div class="profile-container">
        <div class="profile-banner" id="profile_banner_div">
            <div class="profile-inner-banner">
                <div class="profile-banner-body">
                    <div class="title-header text-center">
                        <h4 class="user-display-name">{{ ucfirst($user->user_name) }}</h4>
                        <p class="text-warning">{{ ucfirst($user->membership_level) }}</p>
                    </div>
                    <ul id="user_like_action_btns">
                        <li class="profile-status">
                            Status: <span class="{{ $user->is_active ? 'active' : ''}}">{{ $user->is_active ? 'Online' : 'Offline'}}</span>
                        </li>
                        @if(is_loggedin() && user('id') == $user->id)
                        <li class="profile-settings">
                            <a href="{{ url('/friends') }}"><i class="fa fa-users"></i> Friends</a>
                        </li>
                        <li class="profile-settings">
                            <a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a>
                        </li>
                        @endif
                        @if(!is_loggedin())
                            <li><a href="#" class="login_confirm_modal_popup"><i class="far fa-comment"></i> Message</a></li>
                            <!-- <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-video"></i></a></li> -->
                            <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-heart"></i> Like</a></li>
                        @endif
                         
                        @if(is_loggedin() && user_detail()->id != $user->id)
                            @if($was_liked && $was_liked->is_accept || $you_liked && $you_liked->is_accept)
                            <li><a href="{{ url('/chat/'.$user->id) }}"><i class="far fa-comment"></i> Message</a></li>
                            @endif
                            <!-- <li><a href="#" id="user_video_call_modal_popup"><i class="fa fa-video"></i></a></li> -->
                            @if($was_liked && $was_liked->is_accept || $you_liked && $you_liked->is_accept)
                            <li><a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart"></i> Unlike</a></li>
                            @endif
                            @if(!$was_liked && !$you_liked)
                            <li><a href="#" class="user_like_confirm_modal_popup"><i class="fa fa-heart"></i> Like</a></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-bottom">
            @if(is_loggedin() && user_detail()->id != $user->id && $was_liked && !$was_liked->is_accept )
            <div class="action-like-btn">
                <a href="#" class="user-accept-like-btn accept"><i class="fa fa-heart"></i> Accept</a>
                <a href="#" class="user-cancle-like-request-btn decline"><i class="fa fa-heart"></i> Decline</a>
            </div>
            @endif
            @if(is_loggedin() && user_detail()->id != $user->id && $you_liked && !$you_liked->is_accept)
            <div class="action-like-btn">
                <a href="#" class="user-cancle-like-request-btn decline"><i class="fa fa-heart"></i> Cancle request</a>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- PROFILE START-->



<!-- PROFILE DETAILS START-->
<section class="profile-detail-section">
    <div class="profile-detail-container">
        <div class="row">
            <div class="col-xl-8 col-lg-8"><!-- profile detail left end-->
                @if(Session::has('success'))
                <div class="main-alert-toggle main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                @endif
                <div class="profile-detail-left">
                    <div class="title-header">
                        <h4>Detail info</h4> 
                        @if(is_loggedin() && user('id') == $user->id)
                        <a href="#" id="detail_info_edit_btn_open"><i class="fa fa-pen"></i></a>
                        @endif
                    </div>
                    <ul class="ul-profile-detail" id="ul_profile_detail_body">
                        <li>
                            <div class="title">Name  </div>
                            <div class="body">: {{ ucfirst($display_name) }}</div>
                        </li>
                        <li>
                            <div class="title">I am  </div>
                            <div class="body">: {{ $gender ? ucfirst($gender) : 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Looking for  </div>
                            <div class="body">: {{ $user->looking_for ? ucfirst($user->looking_for) : 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Marital Status  </div>
                            <div class="body">: {{ $user->marital_status ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Age  </div>
                            <div class="body">: {{ $user->age ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Genotype  </div>
                            <div class="body">: {{ $user->genotype ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">HIV Status  </div>
                            @if($user->HIV == 'YES')
                            <div class="body">: Positive</div>
                            @endif
                            @if($user->HIV == 'NO')
                            <div class="body">: Negative</div>
                            @endif
                            @if(!$user->HIV)
                            <div class="body">: Empty</div>
                            @endif
                        </li>
                        <li>
                            <div class="title">Complexion  </div>
                            <div class="body">: {{ $user->complexion ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Education  </div>
                            <div class="body">: {{ $user->education ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Career  </div>
                            <div class="body">: {{ $user->career ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Religion  </div>
                            <div class="body">: {{ $user->religion ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Location  </div>
                            <div class="body">: {{ $user->location ? ucfirst($user->location) : 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Membership level  </div>
                            <div class="body">: {{ $user->membership_level ?? 'Empty' }}</div>
                        </li>
                    </ul>
                </div>
                <div class="profile-detail-left">
                    <div class="title-header">
                        <h4>About me</h4>
                        @if(is_loggedin() && user('id') == $user->id)
                        <a href="#" id="about_me_edit_btn_open"><i class="fa fa-pen"></i></a>
                        @endif
                    </div>
                    <ul class="ul-profile-detail" id="ul_about_me_body">
                        <li>
                            <p class="detail-about-p">{{ $user->about ?? 'Empty' }}</p>
                        </li>
                    </ul>
                </div>
               
                <div class="profile-detail-left">
                    <div class="title-header">
                        <h4>Lifestyle</h4>
                        @if(is_loggedin() && user('id') == $user->id)
                        <a href="#" id="detail_lifestyle_btn_open"><i class="fa fa-pen"></i></a>
                        @endif
                    </div>
                    <ul class="ul-profile-detail" id="ul_life_style_body">
                        <li>
                            <div class="title">Interest  </div>
                            <div class="body">: {{ $user->interest ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Smoking  </div>
                            <div class="body">: {{ $user->smoking ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Drinking  </div>
                            <div class="body">: {{ $user->drinking ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Language  </div>
                            <div class="body">: {{ $user->language ?? 'Empty' }}</div>
                        </li>
                    </ul>
                </div>
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
                            <div class="title">Body type  </div>
                            <div class="body">: {{ $user->body_type ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Ethnicity  </div>
                            <div class="body">: {{ $user->ethnicity ?? 'Empty' }}</div>
                        </li>
                    </ul>
                </div> <!-- profile detail left end-->

            </div> <!-- profile detail left end-->
            <div class="col-xl-4 col-lg-4"> <!-- profile detail right start-->
                <div class="profile-detail-right">
                    <div class="title-header"><h4>Filter Search Members</h4></div>
                    <div class="profile-right-form">
                        <!-- <p>Serious dating with Lagos match maker Yourperfect match is just a click away</p> -->
                        <form action="{{ url('/search') }}" method="GET">
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <select  name="i_am" class="selectpicker form-control">
                                    <option value="">I am</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <select  name="looking_for" class="selectpicker form-control">
                                    <option value="">Looking for</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <div class="row-container">
                                    <select name="from_age" class="selectpicker form-control">
                                        <option value="">Age from</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="55">55</option>
                                        <option value="60">60</option>
                                    </select>
                                    <select name="to_age" class="selectpicker form-control">
                                        <option value="">Age to</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="55">55</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="genotype" class="selectpicker form-control">
                                    <option value="">Select genotype</option>
                                    @if(count($genotypes))
                                        @foreach($genotypes as $genotype)
                                        <option value="{{ $genotype->genotype }}">{{ $genotype->genotype }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="marital_status" class="selectpicker form-control">
                                    <option value="">Marital status</option>
                                    @if(count($marital_status))
                                        @foreach($marital_status as $marital_stat)
                                        <option value="{{ $marital_stat->marital_status }}">{{ $marital_stat->marital_status }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="religion" class="selectpicker form-control">
                                    <option value="">Select religion</option>
                                    <option value="christain">Christain</option>
                                    <option value="muslim">Muslim</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="location" class="selectpicker form-control">
                                    <option value="">Select location</option>
                                    @if(count($states))
                                        @foreach($states as $state)
                                        <option value="{{ strtolower($state->state) }}">{{ $state->state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="membership_level" class="selectpicker form-control">
                                    <option value="">Select membership</option>
                                    <option value="basic">Basic </option>
                                    <option value="premium">Premium </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-fill-block">Filter a match</button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
                @if(is_loggedin() && user_detail()->id != $user->id && $is_friend)
                <div class="profile-detail-right"> <!-- report start-->
                    <div class="title-header"><h4>Report Members</h4></div>
                    <div class="profile-right-form">
                        <p>We use your feeback to help us learn when something's not right.</p>
                        <div class="text-right">
                            <a href="#" id="report_modal_open_btn" class="report-btn">Report</a>
                        </div>
                    </div>
                </div><!-- report end-->
                @endif
            </div><!-- profile detail right end-->
        </div>
    </div>
</section>
<!-- PROFILE DETAILS END-->








<!-- PROFILE MODAL POPUPS START-->

@include('web.profile.modal-popup')


@if(is_loggedin())
    @include('web.profile.profile-report-member-modal-popup')
@endif


@if(is_loggedin() && user('id') == $user->id)
    @include('web.profile.profile-detail-info-modal-popup')
    @include('web.profile.profile-about-modal-popup')
    @include('web.profile.profile-looking-for-modal-popup')
    @include('web.profile.profile-lifestyle-modal-popup')
    @include('web.profile.profile-physical-info-modal-popup')
@endif
<!-- PROFILE MODAL POPUPS START-->


















<!--********************** JQUERY SCRIPTING SECTION ******************-->
@include('web.profile.profile-script')

