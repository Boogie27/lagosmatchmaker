
<!-- SETTINGS HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Settings</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Settings</p>
        </div>
    </div>
</section>
<!-- SETTINGS HEADER START-->







<!-- CHANGE PASSWORD START-->
<section class="settings-section">
    <div class="setting-container">
        @if(Session::has('error-username'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error-username')}}</div>
        @endif
        @if(Session::has('success-username'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success-username')}}</div>
        @endif
        <div class="settings-body"><!-- settings start-->
            <div class="title-header">
                <h4>Update User Name</h4>
                <p>Change current user name details </p>
            </div>
            <div class="content-body-body">
                <form action="{{ url('/update-username') }}" method="POST">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" value="{{ user('user_name') ?? old('username')}}" placeholder="Enter New Username">
                                @if($errors->first('username'))
                                <div class="alert-form text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="news-letter-btn"><i class="fa fa-user"></i> Update Username</button>
                        @csrf
                    </div>
                </form>
            </div>
        </div><!-- settings end-->



        @if(Session::has('error-password'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error-password')}}</div>
        @endif
        @if(Session::has('success-password'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success-password')}}</div>
        @endif
        <div class="settings-body"><!-- settings start-->
            <div class="title-header">
                <h4>Change password</h4>
                <p>Update your current password by filling in a form</p>
            </div>
            <div class="content-body-body">
                <form action="{{ url('/change-password') }}" method="POST">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <input type="password" name="old_password" class="form-control" placeholder="Enter Old Password">
                                <div class="alert-form text-danger">
                                    @if($errors->first('old_password'))
                                        {{ $errors->first('old_password') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="new_password" class="form-control" placeholder="Enter New password" required>
                                <div class="alert-form text-danger">
                                    @if($errors->first('new_password'))
                                        {{ $errors->first('new_password') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm password" required>
                                <div class="alert-form text-danger">
                                    @if($errors->first('confirm_password'))
                                        {{ $errors->first('confirm_password') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="news-letter-btn"><i class="fa fa-key"></i> Update Password</button>
                        @csrf
                    </div>
                </form>
            </div>
        </div><!-- settings end-->


        <div class="settings-body"><!-- settings start-->
            <div class="title-header">
                <h4>Blocked members</h4>
            </div>
            <div class="content-body-body" id="parent_table">
                @if(count($blocked))
                    @foreach($blocked as $block)
                    <div class="block-content">
                        <ul>
                            <li class="block-img">
                                <a href="{{ url('/profile/'.$block->blocked_member) }}"><img src="{{ asset(avatar($block->gender)) }}" alt=""></a>
                                <a href="{{ url('/profile/'.$block->blocked_member) }}">{{ $block->user_name }}</a>
                            </li>
                            <li>
                                <div class="block-date">{{ date('d M Y', strtotime($block->block_date)) }}</div>
                                <a href="#" data-name="{{ $block->user_name }}" id="{{ $block->id }}" class="unblock-modal-open-btn settings-unblock-btn">Unblock</a>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                @endif
            </div>
            <div id="bottom_table_part" class="pb-2">
                @if(!count($blocked))
                <div class="empty-page">
                    <p>There are no blocked members yet!</p>
                </div>
                @endif
                @if(count($blocked))
                <div class="paginate">{{ $blocked->withQueryString()->links("pagination::bootstrap-4") }}</div>
                @endif
            </div>
        </div><!-- settings end-->


        <div class="settings-body"><!-- deactivate start-->
            <div class="title-header">
                <h4 class="text-danger">Deactivate Account</h4>
            </div>
            <div class="content-body-body">
               <p class="p-tag">Account deactivated can only be retreived by contacting the administrator.</p>
               <div class="text-right">
                    <a href="#" id="deactivate_account_modal_open" class="deactivate-btn bg-danger">Deactivate Account</a>
               </div>
            </div>
        </div><!-- deactivate end-->
    </div>
</section>
<!-- BLOCKED MEMBERS END-->















<!--  DELETE PROFILE IMAGE MODAL ALERT START -->
<section class="modal-alert-popup" id="block_member_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to block <b>example</b> ?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <button type="button" id="block_member_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DELETE PROFILE IMAGE MODAL ALERT END -->












<!--  DEACTIVATE ACCOUNT MODAL ALERT START -->
<section class="modal-alert-popup" id="deactivate_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to deactivate this account ?</p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST" class="p-2">
                        <button type="button" id="deactivate_confirm_submit_btn" class="btn btn-block btn-danger">Deactivate Account</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  DEACTIVATE ACCOUNT MODAL ALERT END -->



























<script>
$(document).ready(function(){
    
// ******* EMPTY TABLE MESSAGE **************//
function table_check(){
    var table = $("#parent_table").children()
    if(table.length == 0){
        $("#bottom_table_part").html("<div class='empty-page'><p>There are no blocked members yet!</p></div>")
    }
}



// ********* UNBLOCK MEMBER MODAL OPEN ***********//
var name
var id
var parent
$(".unblock-modal-open-btn").click(function(e){
    e.preventDefault()
    id = $(this).attr('id')
    name = $(this).attr('data-name')
    parent = $(this).parent().parent().parent()

    $("#block_member_modal_popup_box").show()
    $("#block_member_confirm_submit_btn").html('Proceed')
    apend_message('<p>Do you wish to unblock <br><b>'+name+'</b></p>')
})



// ******** BLOCK MEMBER ************//
$("#block_member_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')

     csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-block-member') }}",
        method: "post",
        data: {
            user_id: id,
        },
        success: function (response){
            if(response.data == 'unblocked'){
                $(parent).remove()
                table_check()
                bottom_alert_success(name+' has been unblocked')
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








function apend_message(message){
    $("#block_member_modal_popup_box").find('.confirm-header').html(message)
}




// ********* CSRF PAGE TOKEN ***********//
function csrf_token(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
        }
    });
}






// ********** DEACTIVATE ACCOUNT MODAL OPEN **********//
$("#deactivate_account_modal_open").click(function(e){
    e.preventDefault()
    
    $("#deactivate_modal_popup_box").show()
    $("#deactivate_confirm_submit_btn").html('Deactivate Account')
})






// ******** DEACTIAVTE ACCOUNT ************//
$("#deactivate_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Deactivating...')

     csrf_token() //csrf token

    $.ajax({
        url: "{{ url('/ajax-deactivate-account') }}",
        method: "post",
        success: function (response){
            if(response.data){
               location.assign(response.data)
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















