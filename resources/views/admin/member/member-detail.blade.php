


<!-- BASIC MEMBERS START-->
<section>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid"><!-- Start Content-->
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ ucfirst($user->membership_level) }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($user->user_name) }}</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">{{ ucfirst($display_name) }} Detail</h4>
                        @if(Session::has('error'))
                        <div class="main-alert-danger text-center mt-3">{{ Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                        <div class="main-alert-success text-center mt-3">{{ Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
               
                <!-- PROFILE DETAILS START-->
                <div class="profile-detail-section">
                    <div class="profile-detail-container">
                        <div class="row">
                            <div class="col-xl-12"><!-- profile detail left end-->
                                <div class="profile-detail-left">
                                    <div class="title-header">
                                        <h4>Detail info</h4> 
                                        <a href="#" id="detail_info_edit_btn_open"><i class="fa fa-pen"></i></a>
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
                                        <a href="#" id="about_me_edit_btn_open"><i class="fa fa-pen"></i></a>
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
                                        <a href="#" id="looking_for_btn_open"><i class="fa fa-pen"></i></a>
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
                                       
                                        <a href="#" id="detail_lifestyle_btn_open"><i class="fa fa-pen"></i></a>
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
                            </div> <!-- profile detail left end-->
                        </div>
                    </div>
                </div>
                <!-- PROFILE DETAILS END-->
            </div><!-- end Content-->
        </div>
    </div>
</section>













@include('admin.member.member-detail-modal-popup')
@include('admin.member.profile-about-modal-popup')
@include('admin.member.profile-looking-for-modal-popup')
@include('admin.member.profile-lifestyle-modal-popup')
@include('admin.member.profile-physical-info-modal-popup')






<!-- web/images/ID_card/ID_CARD_60b0ebfe4e531.jpg -->








<script>
$(document).ready(function(){
// ************ OPEN DETAIL MODAL *********//
$("#detail_info_edit_btn_open").click(function(e){
    e.preventDefault();
    $("#edit_detail_info_section").show()
})





// ************ OPEN ABOUT MODAL *********//
$("#about_me_edit_btn_open").click(function(e){
    e.preventDefault();
    $("#about_me_edit_btn_modal").show()
})




// ************ OPEN LOOKING FOR MODAL *********//
$("#looking_for_btn_open").click(function(e){
    e.preventDefault();
    $("#looking_for_modal_popup").show()
})





// ************ OPEN LIFESTYLE MODAL *********//
$("#detail_lifestyle_btn_open").click(function(e){
    e.preventDefault();
    $("#lifestyle_modal_popup").show()
})





// ************ OPEN PHYSICAL MODAL *********//
$("#detail_physical_info_btn_open").click(function(e){
    e.preventDefault();
    $("#physical_info_modal_popup").show()
})



// end
})
</script>