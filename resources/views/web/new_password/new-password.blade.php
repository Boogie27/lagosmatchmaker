

<!-- FORGOT PASSWORD START-->
<section class="login-form-section">
    <div class="form-container">
        <form action="{{ current_url() }}" method="POST">
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
                        @if($errors->first('new_password'))
                        <div class="alert-form text-danger">{{ $errors->first('new_password') }}</div>
                        @endif
                        <input type="password" name="new_password" class="form-control" value="" placeholder="New password">
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
                         <button type="submit" id="login_btn_submit" class="btn-fill-block">Submit</button>
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</section>
<!-- FORGOT PASSWORD END-->











