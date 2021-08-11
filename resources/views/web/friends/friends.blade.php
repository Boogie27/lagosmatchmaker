
@if(count($friends_request))
<!-- HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your matched request</h4>
            <p> <a href="{{ url('/') }}">Home</a> - matches</p>
        </div>
    </div>
</section>
<!-- HEADER START-->
@endif






 @if(count($friends_request))
<!-- MESSAGE SECTION START-->
<section class="friends-section">
    <div class="friends-container">
        <div class="row">
            <div class="col-xl-12"><!-- profile detail left end-->
                @foreach($friends_request as $request)
                @php($name = $request->display_name ? ucfirst($request->display_name) : ucfirst($request->user_name))
                @php($image =  gender($request->gender))
                <div class="firends-main-body"><!-- firend start-->
                    <div class="friends-inner-content">
                        <div class="message-img">
                            <i class="fa fa-circle {{ $request->is_active ? 'active' : '' }}"></i>   
                            <h4>{{ $image }}</h4>
                        </div>
                        <ul class="ul-friends" id="ul_member_anchor">
                            <li>
                                <a href="{{ url('/profile/'.$request->id) }}"><h5>{{ $name }}</h5></a>
                            </li>
                           <li class="friends-bottom">
                                <a href="#" id="{{ $request->id }}" class="accept-user-like-request-friends f-send-msg">Accept request</a>
                                <label for="">
                                   <a href="#" data-name="{{ $name }}" id="{{ $request->id }}" class="cancle-user-like-request" style="color: #fff;">Cancle request</a>
                                </label>
                           </li>
                        </ul>
                    </div>
                    </div><!-- firend end-->
                @endforeach
            </div><!-- profile detail left end-->
        </div>
    </div>
</section>
<!-- MESSAGE SECTION END-->
@endif





<!-- HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your Match</h4>
            @if(count($friends))
               @if(count($friends) == 1)
                <p> You currently have {{ count($friends) }} match</p>
               @else
                <p> You currently have {{ count($friends) }} matches</p>
               @endif
            @endif
        </div>
    </div>
</section>
<!-- HEADER START-->






<!-- MESSAGE SECTION START-->
<section class="friends-section">
    <div class="friends-container">
        @if(count($friends))
        <div class="row">
            <div class="col-xl-12"><!-- profile detail left end-->
                @foreach($friends as $friend)
                @php($user = get_friends(user('id'), $friend))
                @php($display_name = $user->display_name ? ucfirst($user->display_name) : ucfirst($user->user_name))
                @php($image =  gender($user->gender))
                <div class="firends-main-body"><!-- firend start-->
                    <div class="friends-inner-content">
                        <div class="message-img">
                            <i class="fa fa-circle {{ $user->is_active ? 'active' : '' }}"></i>   
                            <h4>{{ $image }}</h4>
                        </div>
                        <ul class="ul-friends">
                            <li>
                                <a href="{{ url('/profile/'.$user->id) }}"><h5>{{ $display_name }}</h5></a>
                            </li>
                           <li class="friends-bottom">
                               <a href="{{ url('/chat/'.$user->id) }}" class="f-send-msg">Send message</a>
                               <label for="">matched</label>
                           </li>
                        </ul>
                    </div>
                    </div><!-- firend end-->
                @endforeach
            </div><!-- profile detail left end-->
        </div>
        @else
        <div class="empty-page">
            <p>You have no friends yet!</p>
        </div>
        @endif
    </div><br><br><br>
</section>
<!-- MESSAGE SECTION END-->












































<script>
$(document).ready(function(){
// *************** ACCPET FRIEND REQUEST *************//
$(".accept-user-like-request-friends").click(function(e){
    e.preventDefault()

    var user_id = $(this).attr('id')
    $("#access_preloader_container").show()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-accept-like-request') }}",
        method: "post",
        data: {
            user_id: user_id,
        },
        success: function (response){
            if(response.subscribe){
                apend_message('<p>Subscribe to match with this member</p>')
                $("#user_confirm_sub_modal_popup").show()
            }else if(response.subscribe_to_premium){
                apend_message('<p>Subscribe to premium to match with this member </p>')
                $("#user_confirm_sub_modal_popup").show()
            }else if(response.matched){
                location.reload()
            }else{
                bottom_error_danger('Network error, try again later!')
            }
            $("#access_preloader_container").hide()
        }, 
        error: function(){
           $("#access_preloader_container").hide()
           bottom_error_danger('Network error, try again later!')
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
}


})
</script>





