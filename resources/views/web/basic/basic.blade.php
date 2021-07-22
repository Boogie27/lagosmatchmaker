<!-- MEMBERS START-->
<section class="members-section">
     <div class="members-container">
        <div class="title-header">
            <h4>Lagos Match Maker <br> Members</h4>
            <p> <a href="{{ url('/') }}">Home</a> - basic</p>
        </div>

        <div class="member-body"><!-- member body start -->
            <div class="top-members-body">
                @if(count($basics))
                <div class="row">
                    @foreach($basics as $basic)
                        @if(user('id') != $basic->id)
                            @php($image =  gender($basic->gender))
                            @php($name = $basic->display_name ? ucfirst($basic->display_name) : ucfirst($basic->user_name))
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12"><!-- member start-->
                                <div class="member-inner-div"> 
                                    <div class="member-img">
                                        <div class="member-img-img">
                                            <h4><a href="{{ url('/profile/'.$basic->id) }}">{{ $image }}</a></h4>
                                        </div>
                                        <ul class="ul-member-anchor" id="ul_member_anchor">
                                            @if(!is_loggedin())
                                            <li><a href="{{ url('/manual-payment') }}" data-name="{{ $name }}" class="confirm_modal_popup"><i class="far fa-envelope"></i></a></li>
                                            <li><a href="{{ url('/manual-payment') }}" data-name="{{ $name }}" class="confirm_modal_popup"><i class="far fa-heart"></i></a></li>
                                            <li><a href="{{ url('/profile/'.$basic->id) }}" data-name="{{ $name }}" class=""><i class="fa fa-info"></i></a></li>
                                            @else
                                                @if(!get_like($basic->id))
                                                <li><a href="{{ url('/ajax-like-user') }}" data-links="{{ url('/ajax-get-member-links') }}" data-url="{{ current_url() }}" data-name="{{ $name }}" class="like-a-member-btn" id="{{ $basic->id }}"><i class="far fa-heart"></i></a></li>
                                                @endif
                                                @if(get_like($basic->id) && get_like($basic->id)->is_accept)
                                                <li><a href="{{ url('/chat/'.$basic->id) }}" data-name="{{ $name }}" id="{{ $basic->id }}"><i class="far fa-envelope"></i></a></li>
                                                <li><a href="#" data-name="{{ $name }}" class="unlike-a-member-btn" id="{{ $basic->id }}"><i class="far fa-heart text-success"></i></a></li>
                                                <li><a href="{{ url('/profile/'.$basic->id) }}" data-name="{{ $name }}" class=""><i class="fa fa-info"></i></a></li>
                                                @endif
                                                @if(get_like($basic->id) && user('id') == get_like($basic->id)->acceptor_id && !get_like($basic->id)->is_accept)
                                                <li><a href="#" data-name="{{ $name }}" id="{{ $basic->id }}" class="cancle-user-like-request cancle-btn">Cancle</a></li>
                                                <li><a href="#"><i class="fa fa-heart text-danger"></i></a></li>
                                                <li><a href="{{ url('/ajax-accept-like-request') }}" data-name="{{ $name }}" data-detail="{{ url('/ajax-get-matched-detail') }}" data-links="{{ url('/ajax-get-member-links') }}" id="{{ $basic->id }}" class="accept-user-like-request accept-btn">Accept</a></li>
                                                @endif
                                                @if(get_like($basic->id) && user('id') == get_like($basic->id)->initiator_id && !get_like($basic->id)->is_accept)
                                                <li><a href="#" data-name="{{ $name }}" class="unlike-a-member-btn" id="{{ $basic->id }}"><i class="far fa-heart text-danger"></i></a></li>
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
                                            <a href="{{ url('/profile/'.$basic->id) }}">
                                                <h4>{{ $name }}</h4>
                                            </a>
                                        </div>
                                        <div class="member-info-container">
                                            <ul class="ul-member-body">
                                                <li>Membership level: <span style="color:  rgb(196, 142, 44);">{{ ucfirst($basic->membership_level) }}</span></li>
                                                <li>Age: <span>{{ $basic->age ?? '' }}</span></li>
                                                <li>Genotype: <span>{{ $basic->genotype ?? '' }}</span></li>
                                                <li>Religion: <span>{{ $basic->religion ?? '' }}</span></li>
                                                <li>State of origin: <span>{{ $basic->state_of_origin ?? '' }}</span></li>
                                                <li>Location: <span>{{ $basic->location ?? '' }}</span></li>
                                                <li>University: <span>{{ $basic->education ?? '' }}</span></li>
                                                <li>Career: <span>{{ $basic->career ?? '' }}</span></li>
                                                <li>Marital status: <span>{{ $basic->marital_status ?? '' }}</span></li>
                                                <li>About: <span>{{ $basic->about ?? '' }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- member end-->
                        @endif
                    @endforeach
                </div>
                @if(count($basics))
                <div class="paginate">{{ $basics->withQueryString()->links("pagination::bootstrap-4") }}</div>
                @endif
                <div class="join-us-btn top-members-btn">
                    <a href="#" data-modal="#member_search_form_modal" class="mr-2"><i class="fa fa-search"></i> Search</a>
                    <a href="{{ url('/basic') }}" class="show-all">All Basics</a>
                    <a href="{{ url('/basic/men') }}" class="middle-btn"><i class="fa fa-male"></i> Men</a>
                    <a href="{{ url('/basic/women') }}"><i class="fa fa-female"></i> Women</a>
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

 






@include('web.basic.basic-member-search-modal-popup')






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