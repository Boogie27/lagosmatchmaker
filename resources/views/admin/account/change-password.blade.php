
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
                                <li class="breadcrumb-item"><a href="javascript: void()">Account</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change password</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Change password</h4>
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
                                   <form action="{{ url('/admin/change-password') }}" method="POST" class="parsley-examples">
                                        <div class="form-group">
                                            <label for="userName">Old password<span class="text-danger">*</span></label>
                                            <input type="password" name="old_password" parsley-trigger="change" placeholder="Old password" class="form-control">
                                            <div class="alert-form text-danger">@if($errors->first('old_password')) {{ $errors->first('old_password') }} @endif</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="userName">New password<span class="text-danger">*</span></label>
                                            <input type="password" name="new_password" parsley-trigger="change" placeholder="New password" class="form-control">
                                            <div class="alert-form text-danger">@if($errors->first('new_password')) {{ $errors->first('new_password') }} @endif</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="userName">Confirm password<span class="text-danger">*</span></label>
                                            <input type="password" name="confirm_password" parsley-trigger="change" placeholder="Confirm password" class="form-control">
                                            <div class="alert-form text-danger">@if($errors->first('confirm_password')) {{ $errors->first('confirm_password') }} @endif</div>
                                        </div>
                                        <br>
                                        <div class="form-group text-right mb-3">
                                            <div class="form-group">
                                                <input type="hidden" name="gender" class="member_gender_input" value="{{ old('gender') }}">
                                                <button type="submit" id="add_member_submit" class="btn-fill-block">Update password</button>
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

















<script>
$(document).ready(function(){
// *********** LOGIN BUTTON *********//
$("#add_member_submit").click(function(e){
    $(this).html('Please wait...')
    $("#access_preloader_container").show()
})


})
</script>