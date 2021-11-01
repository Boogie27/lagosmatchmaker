@php($settings = settings())
@php( $details = json_decode($settings->register_form_detail, true))




<!-- LOGIN START-->
<section class="login-form-section small"  style="background-image: url({{ asset('web/images/banner/night-sky.gif') }})">
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
                        <input type="text" name="email_username" class="form-control" value="" placeholder="Enter Email/username">
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
                    <div class="form-note">
                        <i class="fa fa-bell" style="color: rgb(196, 142, 44);"></i>
                        {{ isset($details['note']) ? $details['note'] : '' }}
                        <a href="{{ url('/reset-username') }}">Reset Username</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- LOGIN END-->




















