
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
                                <li class="breadcrumb-item active" aria-current="page">Email settings</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Email Settings</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="header-title mt-0 mb-1">Buttons example</h4> -->
                               <div class="table-top">
                                    <div class="page-icon"><i class="far fa-envelope"></i></div>
                               </div>
                               <div class="form-validation">
                                    @if(Session::has('error'))
                                    <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
                                    @endif
                                    @if(Session::has('success'))
                                    <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
                                    @endif
                                   <form action="{{ url('/admin/email-settings') }}" method="POST" class="parsley-examples">
                                        <div class="form-group">
                                            <label for="userName">From Name<span class="text-danger">*</span></label>
                                            <input type="text" name="from_name" parsley-trigger="change" placeholder="Enter From Name" class="form-control" value="{{ $email_settings->from_name ?? old('from_name') }}">
                                            <div class="alert-form text-danger">@if($errors->first('from_name')) {{ $errors->first('from_name') }} @endif</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">From Email<span class="text-danger">*</span></label>
                                            <input type="email" name="from_email" parsley-trigger="change" placeholder="Enter From Email" class="form-control" value="{{ $email_settings->from_email ?? old('from_email') }}">
                                            <div class="alert-form text-danger">@if($errors->first('from_email')) {{ $errors->first('from_email') }} @endif</div>
                                        </div>
                                       <div class="row">
                                           <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="userName">SMTP Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="smtp_host" parsley-trigger="change" placeholder="Enter SMTP Name" class="form-control" value="{{ $email_settings->smtp_name ?? old('smtp_name') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('smtp_name')) {{ $errors->first('smtp_name') }} @endif</div>
                                                </div>
                                           </div>
                                           <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="userName">SMTP Password<span class="text-danger">*</span></label>
                                                    <input type="password" name="smtp_password" parsley-trigger="change" placeholder="Enter SMTP Password" class="form-control" value="{{ $email_settings->smtp_password ?? old('smtp_password') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('smtp_password')) {{ $errors->first('smtp_password') }} @endif</div>
                                                </div>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="userName">SMTP Port<span class="text-danger">*</span></label>
                                                    <input type="text" name="smtp_port" parsley-trigger="change" placeholder="Enter SMTP Port" class="form-control" value="{{ $email_settings->smtp_host ?? old('smtp_port') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('smtp_port')) {{ $errors->first('smtp_port') }} @endif</div>
                                                </div>
                                           </div>
                                           <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="userName">SMTP Host<span class="text-danger">*</span></label>
                                                    <input type="text" name="smtp_host" parsley-trigger="change" placeholder="Enter SMTP Host" class="form-control" value="{{ $email_settings->smtp_port ?? old('smtp_host') }}">
                                                    <div class="alert-form text-danger">@if($errors->first('smtp_host')) {{ $errors->first('smtp_host') }} @endif</div>
                                                </div>
                                           </div>
                                       </div>
                                        <div class="form-group text-right mb-3">
                                            <div class="form-group">
                                                <button type="submit" id="email_settings_submit_btn" style="display: none;"></button>
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
                    <p>Do you wish to update <b>email settings</b></p>
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
    $("#email_settings_submit_btn").click()
})


})
</script>