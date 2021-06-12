

<!-- FORGOT PASSWORD START-->
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
                <h3>New password</h3>
                <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('password'))
                        <div class="alert-form text-danger">{{ $errors->first('password') }}</div>
                        @endif
                        <input type="password" name="password" class="form-control" value="" placeholder="New password">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('confirm_password'))
                        <div class="alert-form text-danger">{{ $errors->first('confirm_password') }}</div>
                        @endif
                        <input type="password" name="confirm_password" class="form-control" value="" placeholder="Confirm password">
                    </div>
                </div>
                <div class="col-xl-12 mt-4">
                    <div class="form-group">
                         <button type="submit" class="btn-fill-block">Submit</button>
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</section>
<!-- FORGOT PASSWORD END-->