
@if(count($friends_request))
<!-- HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your friends request</h4>
            <p> <a href="{{ url('/') }}">Home</a> - friends</p>
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
                @php($image = $request->gender == 'male' ? 'M' : 'F')
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
            <h4>Your friends</h4>
            <p> <a href="{{ url('/') }}">Home</a> - friends</p>
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
                @php($display_name = $friend->display_name ? ucfirst($friend->display_name) : ucfirst($friend->user_name))
                @php($image = $friend->gender == 'male' ? 'M' : 'F')
                <div class="firends-main-body"><!-- firend start-->
                    <div class="friends-inner-content">
                        <div class="message-img">
                            <i class="fa fa-circle {{ $friend->is_active ? 'active' : '' }}"></i>   
                            <h4>{{ $image }}</h4>
                        </div>
                        <ul class="ul-friends">
                            <li>
                                <a href="{{ url('/profile/'.$friend->id) }}"><h5>{{ $display_name }}</h5></a>
                            </li>
                           <li class="friends-bottom">
                               <a href="{{ url('/chat/'.$friend->id) }}" class="f-send-msg">Send message</a>
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
            <p>There are no members yet!</p>
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
            location.reload()
        }, 
        error: function(){
           $("#access_preloader_container").hide()
           bottom_error_danger('Network error, try again later!')
        }
    });
})







function bottom_error_danger(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_danger").children('.bottom-alert-danger')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })

    setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}







// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}



})
</script>





