

<!-- FORGOT PASSWORD START-->
<section class="login-form-section">
    <div class="form-container">
        <form action="{{ url('/forgot-password') }}" method="POST">
            @if(Session::has('error'))
            <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
            @endif
            @if(Session::has('success'))
            <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
            @endif
            <div class="title-header text-center">
                <h3>Forgot password</h3>
                <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('email'))
                        <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                        @endif
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    </div>
                </div>
                <div class="col-xl-12 mt-4">
                    <div class="form-group">
                         <button type="submit" class="btn-fill-block">Receive Password</button>
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</section>
<!-- FORGOT PASSWORD END-->