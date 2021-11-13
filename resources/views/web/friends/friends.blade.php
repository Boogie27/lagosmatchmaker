
@if(count($friends_request))
<!-- HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your matches request</h4>
            <p> <a href="{{ url('/') }}">Home</a> - matches</p>
        </div>
    </div>
</section>
<!-- HEADER START-->
@endif






 @if(count($friends_request))
<!-- MESSAGE SECTION START-->
<section class="friends-section">
    <div class="long-bar friends-page" id="matches_request_container">
        <div class="title-header">
            <h3>Match Request ( <span>{{ count( $friends_request) }}</span> )</h3>
            <p>Members who would love to matched with you</p>
        </div>
        <div class="matches-request-container">
            <div class="row">
                @foreach($friends_request as $user)
                @php($image =  gender($user->gender))
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="match-ipod"> <!-- match reqest start-->
                        <div class="match-img">
                            <a href="{{ url('/profile/'.$user->id) }}"> 
                                @if(!is_loggedin() || !is_matched($user->id))
                                <div class="img-letter {{ $user->is_active ? 'active' : '' }}"><h4>{{ $image }}</h4></div>
                                @endif
                                @if(is_loggedin() && is_matched($user->id) && $user->avatar)
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                                @endif
                                @if(is_loggedin() && is_matched($user->id) && !$user->avatar)
                                <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                                @endif
                            </a>
                            <ul>
                                <li> <a href="{{ url('/profile/'.$user->id) }}"> {{ $user->user_name }} </a></li>
                                <li class="level">{{ $user->membership_level}}</li>
                                <li class="date-added">Since {{ date('d M Y', strtotime($user->like_date)) }}</li>
                            </ul>
                        </div>
                        <div class="right-drop-down">
                            <div class="drop-down">
                                <i class="fa fa-ellipsis-h drop-down-btn"></i>
                                <ul class="drop-down-body">
                                    <li>
                                        <a href="{{ url('/profile/'.$user->id) }}">View Detail</a>
                                    </li>
                                    <li>
                                        <a href="#" id="{{ $user->id }}" data-name="{{ $user->user_name }}" class="accept-friend-request-btn">Accept Request</a>
                                    </li>
                                    <li>
                                        <a href="#" data-name="{{ $user->user_name }}" id="{{ $user->like_id }}" class="cancel-user-request-button">Cancel Request</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- match reqest end-->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- MESSAGE SECTION END-->
@endif





<!-- HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your Matches</h4>
            <p> You currently have {{ count($friends_count) }} matches</p>
        </div>
    </div>
</section>
<!-- HEADER START-->






<!-- MESSAGE SECTION START-->
<section class="friends-section">
    <div class="long-bar friends-page" id="user_matches_request_container">
        <div class="title-header">
            <h3>My Matches ( <span>{{ count($friends) }}</span> )</h3>
            <p>Members who you have matched with</p>
        </div>
        @if(count($friends))
        <div class="matches-request-container">
            <div class="row">
                @foreach($friends as $friend)
                @php($user = get_friends(user('id'), $friend))
                @php($image =  gender($user->gender))
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="match-ipod"> <!-- match reqest start-->
                        <div class="match-img">
                            <a href="{{ url('/profile/'.$user->id) }}"> 
                                    @if(!is_loggedin() || !is_matched($user->id))
                                    <div class="img-letter {{ $user->is_active ? 'active' : '' }}"><h4>{{ $image }}</h4></div>
                                    @endif
                                    @if(is_loggedin() && is_matched($user->id) && $user->avatar)
                                    <img src="{{ asset($user->avatar) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                                    @endif
                                    @if(is_loggedin() && is_matched($user->id) && !$user->avatar)
                                    <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active ? 'active' : '' }}">
                                    @endif
                            
                                <!-- <img src="{{ asset(avatar($user->gender)) }}" alt="{{ $user->user_name }}" class="{{ $user->is_active && 'active' }}"> -->
                            </a>
                            <ul>
                                <li> <a href="{{ url('/profile/'.$user->id) }}"> {{ $user->user_name }} </a></li>
                                <li class="level">{{ $user->membership_level}}</li>
                                <li class="date-added">Since {{ date('d M Y', strtotime($friend->like_date)) }}</li>
                            </ul>
                        </div>
                        <div class="right-drop-down">
                            <div class="drop-down">
                                <i class="fa fa-ellipsis-h drop-down-btn"></i>
                                <ul class="drop-down-body">
                                    <li>
                                        <a href="{{ url('/chat/'.$user->id) }}">Chat</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/profile/'.$user->id) }}">View Detail</a>
                                    </li>
                                    <li>
                                        <a href="#" data-name="{{ $user->user_name }}" id="{{ $friend->like_id }}" class="unmatch-user-button">Unmatch Member</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- match reqest end-->
                </div>
                @endforeach
            </div>
        </div>
        @else
            <div class="note-text">You have no matches!</div>
        @endif
        @if(count($friends) && count($friends) > 50)
            <div class="paginate">{{ $friends->withQueryString()->links("pagination::bootstrap-4") }}</div>
        @endif
    </div>
    <br><br><br>
</section>
<!-- MESSAGE SECTION END-->














<!--  CANCLE MATCH REQUEST ALERT START -->
<section class="modal-alert-popup" id="cancel_member_request_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to cancel <b>example</b> ?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="cancel_member_request_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  CANCLE MATCH REQUEST ALERT END -->










<!--  DELETE PROFILE IMAGE MODAL ALERT START -->
<section class="modal-alert-popup" id="unmatch_member_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to unmatch <b>example</b> ?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="unmatch_member_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE PROFILE IMAGE MODAL ALERT END -->



















































<script>
$(document).ready(function(){

// ************** ACCEPT FRIEND REQUEST **************//
$("#matches_request_container").on('click', '.accept-friend-request-btn', function(e){
    e.preventDefault()
    user_id = $(this).attr('id')
    parent = $(this).parent().parent().parent().parent().parent().parent()
    var match_counter = $("#matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 
    
    var display_name = $(".user-display-name").html()
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-accept-like-request') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to accept <br><b>'+display_name+'</b> match</p>')
                $("#membership_sub_modal_popup").show()
                $("#access_preloader_container").hide()
            }else if(response.matched){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)
                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>Match Request ( <span>0</span> )</h3>
                                            <p>Members who would love to match with you</p>
                                        </div>
                                        <div class="note-text">You have no match requests!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
                get_matched_modal(user_id)
               
            }else{
                $("#access_preloader_container").hide()
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
})






// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}






function apend_message(message){
    $("#user_confirm_sub_modal_popup").find('.confirm-header').html(message)
    $("#unmatch_member_modal_popup_box").find('.confirm-header').html(message)
    $("#cancel_member_request_modal_popup_box").find('.confirm-header').html(message)
}










// ********GET MATCHED MODAL ************//
function get_matched_modal(user_id){
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-matched-detail') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.data == false){
                location.reload()
            }else{
                get_user_alert()
                $("#add_match_members_profile").html(response)
                $("#profile_match_open_btn").show()
                $("#access_preloader_container").hide()
            }
        }, 
        error: function(){
           $("#access_preloader_container").hide()
        }
    });
}







// ************** GET USER ALERT *************//
function get_user_alert(){
    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-get-users-notification-count') }}",
        method: "post",
        data: {
            user_alert: 'user_alert',
        },
        success: function (response){
            if(response.data){
                $(".notification_users_icon_js").append('<span class="badge bg-danger">'+response.data+'</span>')
            }else{
                $(".notification_users_icon_js").html('')
            }
        },
    }); 
}












// ************ CANCEL MATCH REQUEST *************//
$("#matches_request_container").on('click', '.cancel-user-request-button', function(e){
    e.preventDefault()
    like_id = $(this).attr('id')
    username = $(this).attr('data-name')

    parent = $(this).parent().parent().parent().parent().parent().parent()
    $("#cancel_member_request_modal_popup_box").show()
    apend_message('<p>Do you wish to unmatch <b>'+username+'</b></p>')
    $("#cancel_member_request_confirm_submit_btn").html('Proceed')
})







$("#cancel_member_request_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

    var match_counter = $("#matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-cancel-match-request') }}",
        method: "post",
        data: {
            like_id: like_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)

                if(counter){
                    $(".notification_users_icon_js").append('<span class="badge bg-danger">'+counter+'</span>')
                }else{
                    $(".notification_users_icon_js").html('')
                }
                
                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>My Matches ( <span>0</span> )</h3>
                                            <p>Members who would love to match with you</p>
                                        </div>
                                        <div class="note-text">You have no match requests!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})




 


// 2966
// 2993




// ********** UNMATCH MEMBER *************//
var username
var like_id
var parent
$("#user_matches_request_container").on('click', '.unmatch-user-button', function(e){
    e.preventDefault()
    like_id = $(this).attr('id')
    username = $(this).attr('data-name')
    parent = $(this).parent().parent().parent().parent().parent().parent()
    apend_message('<p>Do you wish to unmatch <b>'+username+'</b></p>')
    $("#unmatch_member_modal_popup_box").show()
    $("#unmatch_member_confirm_submit_btn").html('Proceed')
})




$("#unmatch_member_confirm_submit_btn").click(function(e){
    e.preventDefault()
    var match_counter = $("#user_matches_request_container .title-header span");
    var counter = parseInt($(match_counter).html()) 

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-umatch-member') }}",
        method: "post",
        data: {
            like_id: like_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
                counter = counter - 1;
                $(match_counter).html(counter)

                if(counter == 0){
                    var empty_match =  `<div class="title-header">
                                            <h3>My Matches ( <span>0</span> )</h3>
                                            <p>Members who you matched with you</p>
                                        </div>
                                        <div class="note-text">You have no matches!</div>`;
                    $("#matches_request_container").html(empty_match)
                }
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})











// end 
})
</script>





