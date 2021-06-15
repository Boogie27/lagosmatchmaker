




<!-- LOGIN START-->
<section class="login-form-section">
    <div class="form-body">
        <div class="container-img">
            <img src="{{ asset('admins/images/icons/logo.png') }}" alt="">
        </div>
        <form action="{{ url('/admin/login') }}" method="POST">
            @if(Session::has('error'))
            <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
            @endif
            @if(Session::has('success'))
            <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
            @endif
            <div class="title-header text-center">
                <h3>Login</h3>
               <p>Login as an administrator</p>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('email'))
                        <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                        @endif
                        <div class="input-content">
                            <div class="input-icon"><i class="fa fa-user"></i></div>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('password'))
                        <div class="alert-form text-danger">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="input-content">
                            <div class="input-icon"><i class="fa fa-key"></i></div>
                            <input type="passsword" name="password" class="form-control" value="" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group text-right">
                        <a href="{{ url('/admin/forgot-password') }}" class="text-danger">Forgot password?</a>
                    </div>
                </div>
                <div class="col-xl-12 mt-4">
                    <div class="form-group">
                         <button type="submit" id="login_admin_submit" class="btn-fill-block">Submit Now</button>
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</section>
<!-- LOGIN END-->










<script>
$(document).ready(function(){
// *********** LOGIN BUTTON *********//
$("#login_admin_submit").click(function(e){
    $(this).html('Please wait...')
})


})
</script>