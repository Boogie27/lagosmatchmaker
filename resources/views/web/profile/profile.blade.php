<!-- PROFILE START-->
@php($user_detail = user_detail())


<section class="profile-section">
    <div class="profile-container">
        <div class="profile-banner" id="profile_banner_div">
            <div class="profile-inner-banner">
                @if(is_loggedin() && $user_detail->id == $user->id)
                <div class="add-profile-img">
                    <a href="#" class="profile-image-option" title="Add profile image"><i class="fa fa-camera"></i></a>
                    <input type="file" id="profile_image_input" style="display: none;">
                </div>
                @endif
                <div class="profile-banner-body">
                    @if(is_loggedin())
                        @if($user_detail->id != $user->id && is_matched($user->id) && $user->avatar || $user_detail->id == $user->id && $user->avatar)
                        <div class="profile-image-img">
                            <img src="{{ asset($user->avatar) }}" alt="">
                        </div>
                        @else
                        <div class="profile-image-img">
                            <img src="{{ asset(avatar($user->gender)) }}" alt="">
                        </div>
                        @endif
                    @else
                    <div class="profile-image-img">
                        <img src="{{ asset(avatar($user->gender)) }}" alt="">
                    </div>
                    @endif
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
                            <a href="{{ url('/friends') }}"><i class="fa fa-users"></i> Matches</a>
                        </li>
                        <li class="profile-settings">
                            <a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a>
                        </li>
                        @endif
                        @if(!is_loggedin())
                            <li><a href="#" class="login_confirm_modal_popup"><i class="far fa-comment"></i> Message</a></li>
                            <!-- <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-video"></i></a></li> -->
                            <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Match</a></li>
                        @endif
                         
                        @if(is_loggedin() && $user_detail->id != $user->id)
                            <li class="li-is-block-content" id="cant_message_member_btn">
                                @if(!is_blocked($user_detail->id, $user->id))
                                    @if(is_matched($user->id))
                                    <a href="{{ url('/chat/'.$user->id) }}"><i class="far fa-comment"></i> Message</a>
                                    @endif
                                @else
                                    @if(is_matched($user->id))
                                    <a href="#" class="cant-message-btn text-danger"><i class="far fa-comment"></i> Message</a>
                                    @endif
                                @endif
                            </li>
                            <!-- <li><a href="#" id="user_video_call_modal_popup"><i class="fa fa-video"></i></a></li> -->
                           
                            <li id="li_unlike_member_btn">
                                @if(is_matched($user->id))
                                <a href="#" id="user_unlike_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Unmatch</a>
                                @endif
                            </li>
                           
                            <li class="li-is-block-content" id="li_like_member_btn">
                                @if(!is_blocked($user_detail->id, $user->id))
                                    @if(!$was_liked && !$you_liked)
                                    <a href="#" class="user_like_confirm_modal_popup"><i class="fa fa-heart text-danger"></i> Match</a>
                                    @endif
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-bottom">
            @if(is_loggedin() && $user_detail->id != $user->id && $was_liked && !$was_liked->is_accept )
            <div class="action-like-btn">
                <a href="#" class="user-accept-like-btn accept"><i class="fa fa-heart"></i> Accept</a>
                <a href="#" class="user-cancle-like-request-btn decline"><i class="fa fa-heart"></i> Decline</a>
            </div>
            @endif
            @if(is_loggedin() && $user_detail->id != $user->id && $you_liked && !$you_liked->is_accept)
            <div class="action-like-btn">
                <a href="#" class="user-cancle-like-request-btn decline"><i class="fa fa-heart"></i> Cancle match</a>
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
                        @if(is_loggedin() && $user_detail->id == $user->id)
                        <li>
                            <div class="title">Phone number  </div>
                            <div class="body">: {{ $user->phone ?? 'Empty' }}</div>
                        </li>
                        @endif
                        <li>
                            <div class="title">Complexion  </div>
                            <div class="body">: {{ $user->complexion ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">University  </div>
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
                            <div class="title">State Of Origin  </div>
                            <div class="body">: {{ $user->state_of_origin ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Location  </div>
                            <div class="body">: {{ $user->location ? ucfirst($user->location) : 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Country  </div>
                            <div class="body">: {{ $user->country ? ucfirst($user->country) : 'Empty' }}</div>
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
                                <select class="selectpicker form-control">
                                    <option value="">I am</option>
                                    <option value="male">Man</option>
                                    <option value="female">Woman</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <select  name="looking_for" class="selectpicker form-control">
                                    <option value="">Looking for</option>
                                    <option value="man">Man</option>
                                    <option value="woman">Woman</option>
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
                                    <option value="christian">Christian</option>
                                    <option value="muslim">Muslim</option>
                                </select>
                            </div>
                           
                            <div class="form-group">
                                <select name="membership_level" class="selectpicker form-control">
                                    <option value="basic">Basic </option>
                                    <option value="premium">Premium </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="location" class="form-control" value="" placeholder="State">
                            </div>
                            <div class="form-group">
                                <input type="text" name="country" class="form-control" value="" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-fill-block">Filter a match</button>
                            </div>
                            @csrf
                        </form>
                        @if(settings() && settings()->home_page)
                        @php($home_page = json_decode(settings()->home_page, true))
                        <div class="search-bottom-info inner-search">
                            <p>
                                <i class="fa fa-bell"></i>
                                {!! nl2br($home_page['search_bottom']) !!}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                @if(is_loggedin() && $user_detail->id != $user->id && $is_friend)
                <div class="profile-detail-right"> <!-- report start-->
                    <div class="title-header"><h4>Report Member</h4></div>
                    <div class="profile-right-form">
                        <p>We use your feeback to help us learn when something's not right.</p>
                        <div class="text-right">
                            <a href="#" id="report_modal_open_btn" class="report-btn">Report</a>
                        </div>
                    </div>
                </div><!-- report end-->
                @endif
                @if(is_loggedin() && $user_detail->id != $user->id)
                <div class="profile-detail-right"> <!-- report start-->
                    <div class="title-header"><h4>Block Member</h4></div>
                    <div class="profile-right-form">
                        <p>
                            Blocked members will not be able to send or receive message from you.
                            To view blocked members, goto settings.
                        </p>
                        <div class="text-right" id="member_block_container">
                            @if($is_blocked)
                            <a href="#" id="unblock_modal_open_btn" class="report-btn">Unblock</a>
                            @else
                            <a href="#" id="block_modal_open_btn" class="report-btn">Block</a>
                            @endif
                        </div>
                    </div>
                </div><!-- report end-->
                @endif
                <div class="profile-detail-right"> <!-- report start-->
                    <div class="profile-right-form">
                        <p>
                            To view blocked members, goto <a href="{{ url('/settings') }}"  class="report-btn">Settings</a>
                        </p>
                    </div>
                </div><!-- report end-->
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

