

<!-- LOGIN START-->
<section class="login-form-section">
    <div class="form-container">
        <form action="{{ url('/login') }}" method="POST">
            @if(Session::has('error'))
            <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
            @endif
            @if(Session::has('success'))
            <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
            @endif
            <div class="title-header text-center">
                <h3>Login</h3>
                <p>Don't have an account? <a href="{{ url('/register') }}">Register</a></p>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('email'))
                        <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                        @endif
                        <input type="email" name="email" class="form-control" value="" placeholder="Email">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('password'))
                        <div class="alert-form text-danger">{{ $errors->first('password') }}</div>
                        @endif
                        <input type="password" name="password" class="form-control" value="" placeholder="Password">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6-col-sm-6 col-6">
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"> <span>Remember me</span>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6-col-sm-6 col-6">
                    <div class="form-group text-right">
                    <a href="{{ url('/forgot-password') }}" class="text-danger">Forgot password?</a>
                    </div>
                </div>
                <div class="col-xl-12 mt-4">
                    <div class="form-group">
                         <button type="submit" id="login_form_submit" class="btn-fill-block">Submit Now</button>
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
$("#login_form_submit").click(function(e){
    $(this).html('Please wait...')
})


})
</script>