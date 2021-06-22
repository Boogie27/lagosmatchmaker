<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void()">Members</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Basic</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Basic members</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="header-title mt-0 mb-1">Buttons example</h4> -->
                               <div class="table-top">
                                    <div class="page-icon"><i class="fa fa-users"></i></div>
                                    <div class="table-search">
                                        <form action="" method="GET">
                                            <div class="form-group">
                                                <input type="text" name="search_members" class="form-control" placeholder="Search...">
                                            </div>
                                        </form>
                                    </div>
                               </div>
                               <div class="table-responsive"> <!-- table start-->
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($basics))
                                            @foreach($basics as $basic)
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div> <!--table end -->
                                @if(!count($basics))
                                <div class="text-center">There are no members yet!</div>
                                @endif
                                @if(count($basics))
                                <div class="paginate">{{ $basics->links("pagination::bootstrap-4") }}</div>
                                @endif
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->



































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
        </div>
    </div>
</section>
<!-- PROFILE DETAILS END-->

























 @if(count($notifications))
    @foreach($notifications as $notification)
    <a href="{{ url($notification->link) }}" class="dropdown-item border-bottom">
        <p class="notify-details">{{ ucfirst($notification->title) }}</p>
        <p class="text-muted mb-0 user-msg">
            <small>{{ $notification->description }}</small>
        </p>
    </a>
    @endforeach
@else
<div class="text-center pt-3">There are no unseen notifications</div>
@endif