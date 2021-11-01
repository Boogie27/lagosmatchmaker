@php($user_detail = user_detail())

<!-- MESSAGES HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Your messages</h4>
            <p> <a href="{{ url('/') }}">Home</a> - messages</p>
        </div>
    </div>
</section>
<!-- MESSAGES HEADER START-->








<!-- MESSAGE SECTION START-->
<section class="message-section-chart">
    <div class="profile-detail-container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="message-content ul_message_container"><!-- message content start -->
                    @if(count($users))
                        @foreach($users as $user)
                            @php($last_chat = last_chat($user->id))
                            @php($unread_message = unread($user->id))
                            @php($image =  gender($user->gender))
                            <div class="message-inner-content">
                                <div class="message-img">
                                    <i class="fa fa-circle {{ $user->is_active ? 'active' : '' }}"></i>   
                                    @if(!is_loggedin() || !is_matched($user->id))
                                    <h4>{{ $image }}</h4>
                                    @endif
                                    @if(is_loggedin() && is_matched($user->id) && $user->avatar)
                                    <img src="{{ asset($user->avatar) }}" alt="">
                                    @endif
                                    @if(is_loggedin() && is_matched($user->id) && !$user->avatar)
                                    <img src="{{ asset(avatar($user->gender)) }}" alt="">
                                    @endif
                                </div>
                                <ul class="ul-message">
                                    <li>
                                        <h5>
                                            <a href="{{ url('/chat/'.$user->id) }}"> {{ display_name($user->display_name, $user->user_name) }}  </a>  
                                            <span class="badge bg-success chat-unread-message" style="color: #fff; display: {{ $unread_message ? 'inline-block' : 'none' }}">{{ $unread_message }}</span>
                                            <div class="notification-drop-down">
                                                <i class="fa fa-ellipsis-h drop-down-btn notification-icon"></i>
                                                <ul class="drop-down-body ul-notification-body">
                                                    <li><a href="#" id="{{ $user->id }}" class="confirm_modal_popup_btn">Delete</a></li>
                                                    
                                                    <li><a href="#" id="{{  $last_chat->chat_token }}" class="mark-message-seen-btn">mark as seen</a></li>
                                                </ul>
                                            </div>
                                        </h5>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="{{ url('/chat/'.$user->id) }}" class="{{ !$last_chat->is_seen && user('id') != $last_chat->sender_id  ? 'unread-message' : '' }}"> 
                                                @if($last_chat->type == 'image')
                                                    <i class="fa fa-image" style="font-size: 20px;"></i>
                                                @endif
                                                @if($last_chat->type == 'text')
                                                    {{ substr($last_chat->chat, 0, 100) }} 
                                                @endif
                                            </a>
                                            <span class="float-right">{{ chat_time($last_chat->time) }}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div><!-- message content end -->
                <div id="bottom_table_part">
                    @if(!count($users))
                    <div class="empty-message-page">
                        <div class="inner-content-item">
                            <i class="far fa-envelope"></i>
                            <p>There are no messages yet!</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
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
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select name="hiv" class="selectpicker form-control">
                                        <option value="">HIV Status</option>
                                        <option value="YES">Positive</option>
                                        <option value="NO">Negative</option>
                                    </select>
                                </div>
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
            </div><!-- profile detail right end-->
        </div>
    </div>
</section>
<!-- MESSAGE SECTION END-->














@include('web.message.member-search-modal-popup')
















<!-- CONFIRM ALERT START -->
<section class="modal-alert-popup" id="confirm_modal_popup_container">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you want to delete this message</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="delete_max_message_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONFIRM ALERT END -->






















<script>
$(document).ready(function(){
// ***************** OPEN MESSAGE DELETE MODAL *************//
var parent
var user_id
$(".ul_message_container").on('click', '.confirm_modal_popup_btn', function(e){
    e.preventDefault()
    user_id = $(this).attr('id')
    parent = $(this).parent().parent().parent().parent().parent().parent().parent()
    $("#confirm_modal_popup_container").show()
    $("#delete_max_message_confirm_submit_btn").html('Proceed')    
})








// *************** MAX DELETE MESSAGE ***************//
$("#delete_max_message_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-max-users-message-delete') }}",
        method: "post",
        data: {
            user_id: user_id
        },
        success: function (response){
            if(response.data){
                $(parent).remove()
                table_check()
                bottom_alert_success('Message deleted successfully!')
            }else{
                bottom_alert_error('Network error, try again later!')
            }
            $(".modal-alert-popup").hide()
        console.log(response)
        }, 
        error: function(){
            $(".modal-alert-popup").hide()
            bottom_alert_error('Network error, try again later!')
        }
    });
})









// ********** MAX MARK MESSAGE AS SEEN **************//
var parentHeader
$(".mark-message-seen-btn").click(function(e){
    e.preventDefault()
    var chat_token = $(this).attr('id')
    parentHeader = $(this).parent().parent().parent().parent()

    csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-mark-seen-user-chat') }}",
        method: "post",
        data: {
            chat_token: chat_token
        },
        success: function (response){
            if(response.data){
                $(parentHeader).children('.chat-unread-message').remove()
            }else{
                bottom_alert_error('Network error, try again later!')
            }
        }, 
        error: function(){
            bottom_alert_error('Network error, try again later!')
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







// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $(".ul_message_container").children()
    if(table.length == 0){
        $("#bottom_table_part").html("<div class='empty-page'><p>There are no messages yet!</p></div>")
    }
    console.log(table.length)
}



// end
})
</script>



