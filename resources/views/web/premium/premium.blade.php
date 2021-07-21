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
                        @if(user('id') != $premium->id)
                            @php($image =  gender($premium->gender))
                            @php($name = $premium->display_name ? ucfirst($premium->display_name) : ucfirst($premium->user_name))
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12"><!-- member start-->
                                <div class="member-inner-div"> 
                                    <div class="member-img">
                                        <div class="member-img-img">
                                            <h4><a href="{{ url('/profile/'.$premium->id) }}">{{ $image }}</a></h4>
                                        </div>
                                        <ul class="ul-member-anchor" id="ul_member_anchor">
                                            @if(!is_loggedin())
                                            <li><a href="{{ url('/manual-payment') }}" data-name="{{ $name }}" class="confirm_modal_popup"><i class="far fa-envelope"></i></a></li>
                                            <li><a href="{{ url('/manual-payment') }}" data-name="{{ $name }}" class="confirm_modal_popup"><i class="far fa-heart"></i></a></li>
                                            <li><a href="{{ url('/profile/'.$premium->id) }}" data-name="{{ $name }}" class=""><i class="fa fa-info"></i></a></li>
                                            @else
                                                @if(!get_like($premium->id))
                                                <li><a href="{{ url('/ajax-like-user') }}" data-links="{{ url('/ajax-get-member-links') }}" data-url="{{ current_url() }}" data-name="{{ $name }}" class="like-a-member-btn" id="{{ $premium->id }}"><i class="far fa-heart"></i></a></li>
                                                @endif
                                                @if(get_like($premium->id) && get_like($premium->id)->is_accept)
                                                <li><a href="{{ url('/chat/'.$premium->id) }}" data-name="{{ $name }}" id="{{ $premium->id }}"><i class="far fa-envelope"></i></a></li>
                                                <li><a href="#" data-name="{{ $name }}" class="unlike-a-member-btn" id="{{ $premium->id }}"><i class="far fa-heart text-success"></i></a></li>
                                                <li><a href="{{ url('/profile/'.$premium->id) }}" data-name="{{ $name }}" class=""><i class="fa fa-info"></i></a></li>
                                                @endif
                                                @if(get_like($premium->id) && user('id') == get_like($premium->id)->acceptor_id && !get_like($premium->id)->is_accept)
                                                <li><a href="#" data-name="{{ $name }}" id="{{ $premium->id }}" class="cancle-user-like-request cancle-btn">Cancle</a></li>
                                                <li><a href="#"><i class="fa fa-heart text-danger"></i></a></li>
                                                <li><a href="{{ url('/ajax-accept-like-request') }}" data-name="{{ $name }}" data-detail="{{ url('/ajax-get-matched-detail') }}" data-links="{{ url('/ajax-get-member-links') }}" id="{{ $premium->id }}" class="accept-user-like-request accept-btn">Accept</a></li>
                                                @endif
                                                @if(get_like($premium->id) && user('id') == get_like($premium->id)->initiator_id && !get_like($premium->id)->is_accept)
                                                <li><a href="#" data-name="{{ $name }}" class="unlike-a-member-btn" id="{{ $premium->id }}"><i class="far fa-heart text-danger"></i></a></li>
                                                @endif
                                            @endif
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
                                                <li>Membership level: <span style="color:  rgb(196, 142, 44);">{{ ucfirst($premium->membership_level) }}</span></li>
                                                <li>Age: <span>{{ $premium->age ?? '' }}</span></li>
                                                <li>Genotype: <span>{{ $premium->genotype ?? '' }}</span></li>
                                                <li>Religion: <span>{{ $premium->religion ?? '' }}</span></li>
                                                <li>Location: <span>{{ $premium->location ?? '' }}</span></li>
                                                <li>University: <span>{{ $premium->education ?? '' }}</span></li>
                                                <li>Career: <span>{{ $premium->career ?? '' }}</span></li>
                                                <li>Marital status: <span>{{ $premium->marital_status ?? '' }}</span></li>
                                                <li>About: <span>{{ $premium->about ?? '' }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- member end-->
                        @endif
                    @endforeach
                </div>
                @if(count($premiums))
                <div class="paginate">{{ $premiums->withQueryString()->links("pagination::bootstrap-4") }}</div>
                @endif
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