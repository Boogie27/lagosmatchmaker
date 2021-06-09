<!-- PROFILE START-->
<section class="profile-section">
    <div class="profile-container">
        <div class="profile-banner" style="background-image: linear-gradient(rgba(0, 0, 0, 0.274), rgba(0, 0, 0, 0.288)) , url({{ asset('web/images/banner/1.jpg') }});">
            <div class="profile-inner-banner">
                <div class="profile-img" id="profile_img_container">
                    <img src="{{ asset($profile_image) }}" alt="{{ $user->user_name }}">
                    @if(is_loggedin() && user('id') == $user->id)
                    <a href="{{ url('/fetch-all-avatar') }}" id="profile_img_upload_btn" class="p-img-upload-btn"><i class="fa fa-camera"></i></a>
                    @endif
                </div>
                <div class="profile-banner-body">
                    <div class="title-header text-center">
                        <h4 class="user-display-name">{{ $display_name }}</h4>
                        <p class="text-warning">{{ ucfirst($user->membership_level) }}</p>
                    </div>
                    <ul id="user_like_action_btns">
                        <li class="profile-status">
                            Status: <span class="{{ $user->is_active ? 'active' : ''}}">{{ $user->is_active ? 'Online' : 'Offline'}}</span>
                        </li>
                        @if(!is_loggedin())
                            <li><a href="#" class="login_confirm_modal_popup"><i class="far fa-comment"></i> Message</a></li>
                            <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-video"></i></a></li>
                            <li><a href="#" class="login_confirm_modal_popup"><i class="fa fa-heart"></i> Like</a></li>
                        @endif
                         
                        @if(is_loggedin() && user_detail()->id != $user->id)
                            @if($was_liked && $was_liked->is_accept || $you_liked && $you_liked->is_accept)
                            <li><a href="{{ url('/chat/'.$user->id) }}"><i class="far fa-comment"></i> Message</a></li>
                            @endif
                            <li><a href="#" id="user_video_call_modal_popup"><i class="fa fa-video"></i></a></li>
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
   <div class="mobile-like-btn">
        @if(is_loggedin() && user_detail()->id != $user->id && $was_liked)
        <div class="action-like-btn">
            <a href="#" class="user-accept-like-btn accept"><i class="fa fa-heart"></i> Accept</a>
            <a href="#" class="user-decline-like-btn decline"><i class="fa fa-heart"></i> Decline</a>
        </div>
        @endif
        @if(is_loggedin() && user_detail()->id != $user->id && $you_liked && !$you_liked->is_accept)
        <div class="action-like-btn">
            <a href="#" class="user-cancle-like-request-btn decline"><i class="fa fa-heart"></i> Cancle request</a>
        </div>
        @endif
   </div>
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
                            <div class="title">Religion  </div>
                            <div class="body">: {{ $user->religion ?? 'Empty' }}</div>
                        </li>
                        <li>
                            <div class="title">Date of Birth  </div>
                            <div class="body">: {{ $user->date_of_birth ? date('d M Y', strtotime($user->date_of_birth)) : 'Empty'}}</div>
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
            </div> <!-- profile detail left end-->
            <div class="col-xl-4 col-lg-4"> <!-- profile detail right start-->
                <div class="profile-detail-right">
                    <div class="title-header"><h4>Filter Search Members</h4></div>
                    <div class="profile-right-form">
                        <p>Serious dating with Lagos match maker Yourperfect match is just a click away</p>
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <select class="selectpicker form-control">
                                    <option value="">I am</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <select class="selectpicker form-control">
                                    <option value="">Looking for</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <div class="row-container">
                                    <select class="selectpicker form-control">
                                        <option value="">18</option>
                                        <option value="">20</option>
                                        <option value="">25</option>
                                        <option value="">30</option>
                                        <option value="">35</option>
                                        <option value="">40</option>
                                        <option value="">45</option>
                                        <option value="">50</option>
                                        <option value="">55</option>
                                        <option value="">60</option>
                                    </select>
                                    <select class="selectpicker form-control">
                                        <option value="">18</option>
                                        <option value="">20</option>
                                        <option value="">25</option>
                                        <option value="">30</option>
                                        <option value="">35</option>
                                        <option value="">40</option>
                                        <option value="">45</option>
                                        <option value="">50</option>
                                        <option value="">55</option>
                                        <option value="">60</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <input type="text" class="form-control" value="" placeholder="City">
                            </div>
                            <div class="form-group">
                                <div class="alert-form text-danger"></div>
                                <input type="text" class="form-control" value="" placeholder="State">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn-fill-block">Filter Your Partner</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="you-may-like"><!-- you may like start-->
                    <div class="title-header"><h4>You May Like</h4></div>
                    @if(count($you_may_like))
                    <div class="you-may-like-body">
                        <div class="row">
                            @foreach($you_may_like as $member)
                            @php($image = avatar($member->display_image, $member->gender))
                            <div class="col-xl-4 col-lg-4 col-md-3 col-sm-4 col-4 like-expand"><!-- like start-->
                                <div class="like-content">
                                    <a href="{{ url('/profile/'.$member->id) }}">
                                        <img src="{{ asset($image) }}" alt="{{ $member->user_name }}">
                                    </a>
                                </div>
                            </div><!-- like end-->
                            @endforeach
                        </div>
                    </div>
                    @else 
                    <div class="empty-page p-3">
                        <p>There are no members yet!</p>
                    </div>
                    @endif
                </div><!-- you may like end-->
            </div><!-- profile detail right end-->
        </div>
    </div>
</section>
<!-- PROFILE DETAILS END-->








<!-- PROFILE MODAL POPUPS START-->

@include('web.profile.modal-popup')

@if(is_loggedin() && user('id') == $user->id)
    @include('web.profile.profile-image-modal-popup')
    @include('web.profile.profile-detail-info-modal-popup')
    @include('web.profile.profile-about-modal-popup')
    @include('web.profile.profile-looking-for-modal-popup')
    @include('web.profile.profile-lifestyle-modal-popup')
    @include('web.profile.profile-physical-info-modal-popup')
@endif
<!-- PROFILE MODAL POPUPS START-->


















<!--********************** JQUERY SCRIPTING SECTION ******************-->
@include('web.profile.profile-script')

