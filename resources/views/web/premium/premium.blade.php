<!-- MEMBERS START-->
<section class="members-section">
     <div class="members-container">
        <div class="title-header">
            <h4>Lagos Match Maker <br> Members</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Premium</p>
        </div>

        <div class="member-body"><!-- member body start -->
            <div class="top-members-body">
                @if(count($premiums))
                <div class="row">
                    @foreach($premiums as $premium)
                    @php($image =  avatar($premium->display_image, $premium->gender))
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12"><!-- member start-->
                        <div class="member-inner-div"> 
                            <div class="member-img">
                                <div class="member-img-img">
                                    <a href="{{ url('/profile/'.$premium->id) }}">
                                        <img src="{{ asset($image) }}" alt="{{ $premium->user_name}}">
                                    </a>
                                    <i class="fa fa-circle {{ $premium->is_active ? 'active' : '' }}"></i>
                                </div>
                                <ul class="ul-member-anchor">
                                   <li><a href="{{ url('/chat') }}"><i class="far fa-envelope"></i></a></li>
                                   <li><a href="#" class="profile_like_member"><i class="far fa-heart"></i></a></li>
                                   <li><a href="#" class="video_call_open_btn" id="{{ $premium->id }}"><i class="fa fa-video"></i></a></li>
                                </ul>
                            </div>
                            <div class="member-body-div member-body-container">
                                <div class="direction">
                                    <a href="#" class="member_angle_up"><i class="fa fa-angle-up"></i></a>
                                    <a href="#" class="member_angle_down"><i class="fa fa-angle-down"></i></a>
                                </div> 
                                <div class="member-name">
                                    <a href="{{ url('/profile/'.$premium->id) }}">
                                        <h4>{{ $premium->display_name ? ucfirst($premium->display_name) : ucfirst($premium->user_name) }}</h4>
                                    </a>
                                </div>
                                <div class="member-info-container">
                                    <ul class="ul-member-body">
                                        <li>Looking for: <span>{{ $premium->looking_for ?? '' }}</span></li>
                                        <li>Marital status: <span>{{ $premium->marital_status ?? '' }}</span></li>
                                        <li>Genotype: <span>{{ $premium->genotype ?? '' }}</span></li>
                                        <li>Height: <span>{{ $premium->height ?? '' }}</span></li>
                                        <li>Weight: <span>{{ $premium->weight ?? '' }}</span></li>
                                        <li>Religion: <span>{{ $premium->religion ?? '' }}</span></li>
                                        <li>Language: <span>{{ $premium->language ?? '' }}</span></li>
                                        <li>Location: <span>{{ $premium->location ?? '' }}</span></li>
                                        <li>Membership level: <span style="color:  rgb(196, 142, 44);">{{ ucfirst($premium->membership_level) }}</span></li>
                                        <li>Interest: <span>{{ $premium->interest ?? '' }}</span></li>
                                        <li>About: <span>{{ $premium->about ?? '' }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- member end-->
                    @endforeach
                </div>
                <div class="join-us-btn top-members-btn">
                    <a href="#" data-modal="#member_search_form_modal" class="mr-2"><i class="fa fa-search"></i> Search</a>
                    <a href="{{ url('/premium') }}" class="show-all">All premium</a>
                    <a href="{{ url('/premium/men') }}" class="middle-btn"><i class="fa fa-male"></i> Men</a>
                    <a href="{{ url('/premium/women') }}"><i class="fa fa-female"></i> Women</a>
                </div>
                @else
                <div class="empty-page">
                    <p>There are no members yet!</p>
                </div>
                @endif
            </div>
        </div>
     </div>
</section>
<!-- MEMBERS END-->

 












@include('web.premium.modal-popup')
@include('web.premium.premium-member-search-modal-popup')






<script>
$(document).ready(function(){
// ********* OPEN VIDEO CALL **********//
$(".video_call_open_btn").click(function(e){
    e.preventDefault()
    $("#video_call_section").show()
})







// ********* CLOSE VIDEO CALL ***********//
$("#video_call_close_btn").click(function(e){
    e.preventDefault()
    $("#video_call_section").hide()
})







// ********* LIKE A MEMBER ***********//
$(".profile_like_member").click(function(e){
    e.preventDefault()
    $("#profile_match_section").show()
})





// ********* CLOSE PROFILE MATCH ***********//
$("#profile_match_close_btn").click(function(e){
    e.preventDefault()
    $("#profile_match_section").hide()
})





})
</script>