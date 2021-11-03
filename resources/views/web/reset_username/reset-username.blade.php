

<!-- CHANGE USERNAME START-->
<section class="login-form-section small">
    <div class="form-container">
        <form action="{{ current_url() }}" method="POST">
            @if(Session::has('error'))
            <div class="main-alert-danger text-center mb-3">{{ Session::get('error')}}</div>
            @endif
            @if(Session::has('success'))
            <div class="main-alert-success text-center mb-3">{{ Session::get('success')}}</div>
            @endif
            <div class="title-header text-center">
                <h3>Reset Username</h3>
                <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group">
                        @if($errors->first('email'))
                        <div class="alert-form text-danger">{{ $errors->first('email') }}</div>
                        @endif
                        <input type="email" name="email" class="form-control" value="" placeholder="Enter Email">
                    </div>
                </div>
                <div class="col-xl-12 mt-4">
                    <div class="form-group">
                         <button type="submit" class="btn-fill-block">Submit</button>
                    </div>
                    <div class="form-note">
                        <i class="fa fa-bell" style="color: rgb(196, 142, 44);"></i>
                        A username reset token will be sent to you by email, please ensure to check your email soon
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</section>
<!-- CHANGE USERNAME END-->











