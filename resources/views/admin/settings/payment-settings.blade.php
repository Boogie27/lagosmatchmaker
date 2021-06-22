
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
                                <li class="breadcrumb-item"><a href="javascript: void()">Settings</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment settings</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Payment Settings</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="header-title mt-0 mb-1">Buttons example</h4> -->
                               <div class="table-top">
                                    <div class="page-icon"><i class="fa fa-key"></i></div>
                               </div>
                               <div class="form-validation">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                   <form action="{{ url('/admin/payment-settings') }}" method="POST" class="parsley-examples">
                                        <div class="form-group">
                                            <label for="userName">Secrete key<span class="text-danger">*</span></label>
                                            <input type="text" name="live_key" parsley-trigger="change" placeholder="Enter Live Key" class="form-control" value="{{ $paystack->paystack_live_key ?? old('live_key') }}">
                                            <div class="alert-form text-danger">@if($errors->first('live_key')) {{ $errors->first('live_key') }} @endif</div>
                                            <div class="checkbox checkbox-success">
                                                <input id="live_key_checker" type="checkbox" class="active_key_checkbox_input"  value="0" {{  !$paystack->is_paystack_activate ? 'checked' : '' }}>
                                                <label for="live_key_checker">
                                                    Activate Test key
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Public Key<span class="text-danger">*</span></label>
                                            <input type="text" name="test_key" parsley-trigger="change" placeholder="Enter Test Key" class="form-control" value="{{ $paystack->paystack_test_key ?? old('test_key') }}">
                                            <div class="alert-form text-danger">@if($errors->first('test_key')) {{ $errors->first('test_key') }} @endif</div>
                                            <div class="checkbox checkbox-success">
                                                <input id="test_key_checker" type="checkbox" class="active_key_checkbox_input" value="1" {{  $paystack->is_paystack_activate ? 'checked' : '' }}>
                                                <label for="test_key_checker">
                                                    Activate Live key
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group text-right mb-3">
                                            <div class="form-group">
                                                <input type="hidden" name="is_paystack_activate" class="payment_key_input" value="{{  $paystack->is_paystack_activate }}">
                                                <button type="submit" id="payment_settings_submit_btn" style="display: none;"></button>
                                                <button type="button" id="settings_submit_btn" class="btn-fill-block">Update settings</button>
                                            </div>
                                            @csrf
                                        </div>
                                    </form>
                               </div>
                            </div>
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</section>
<!-- BASIC MEMBERS END-->












<!--  SEEN MODAL ALERT START -->
<section class="modal-alert-popup" id="settings_confirm_modal_popup_box">
    <div class="sub-confirm-container">
        <div class="sub-confirm-dark-theme">
            <div class="sub-inner-content">
                <div class="text-right p-2">
                    <button class="confirm-box-close"><i class="fa fa-times"></i></button>
                </div>
                <div class="confirm-header">
                    <p>Do you wish to update <b>payment settings</b></p>
                </div>
                <div class="confirm-form">
                    <form action="" method="POST">
                        <input type="hidden" id="feature_id_input">
                        <button type="button"  id="settings_confirm_submit_btn" class="confirm-btn">Proceed</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  SEEN MODAL ALERT END -->


























<script>
$(document).ready(function(){
// *********** EMAIL SETTINGS  BUTTON *********//
$("#settings_submit_btn").click(function(e){
    e.preventDefault()
    $("#settings_confirm_modal_popup_box").show()
})





// ******** UPDATE EMAIL SETTINGS *************//
$("#settings_confirm_submit_btn").click(function(e){
    e.preventDefault()
    $(this).html('Please wait...')
    $("#payment_settings_submit_btn").click()
})




// ********** GENDER INPUT ************//
var key = $(".active_key_checkbox_input");
$.each($(".active_key_checkbox_input"), function(index, current){
    $(this).click(function(){
        for(var i = 0; i < key.length; i++){
            if(index != i)
            {
               $($(key)[i]).prop('checked', false);
            }else{
                $($(key)[i]).prop('checked', true);
            }
        }
    });
});


$(key).click(function(){
    $(".payment_key_input").val($(this).val());
});



})
</script>