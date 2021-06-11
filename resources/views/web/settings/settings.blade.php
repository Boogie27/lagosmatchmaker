
<!-- SETTINGS HEADER START-->
<section class="message-section">
    <div class="message-container">
        <div class="title-header">
            <h4>Settings</h4>
            <p> <a href="{{ url('/') }}">Home</a> - Settings</p>
        </div>
    </div>
</section>
<!-- SETTINGS HEADER START-->







<!-- CHANGE PASSWORD START-->
<section class="settings-section">
    <div class="setting-container">
        @if(Session::has('error-username'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error-username')}}</div>
        @endif
        @if(Session::has('success-username'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success-username')}}</div>
        @endif
        <div class="settings-body"><!-- settings start-->
            <div class="title-header">
                <h4>Update User Name</h4>
                <p>Change current user name details </p>
            </div>
            <div class="content-body-body">
                <form action="{{ url('/update-username') }}" method="POST">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" value="{{ user('user_name') ?? old('username')}}" placeholder="Enter New Username">
                                @if($errors->first('username'))
                                <div class="alert-form text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="news-letter-btn"><i class="fa fa-user"></i> Update Username</button>
                        @csrf
                    </div>
                </form>
            </div>
        </div><!-- settings end-->



        @if(Session::has('error-password'))
        <div class="main-alert-danger text-center mb-3">{{ Session::get('error-password')}}</div>
        @endif
        @if(Session::has('success-password'))
        <div class="main-alert-success text-center mb-3">{{ Session::get('success-password')}}</div>
        @endif
        <div class="settings-body"><!-- settings start-->
            <div class="title-header">
                <h4>Change password</h4>
                <p>Update your current password by filling in a form</p>
            </div>
            <div class="content-body-body">
                <form action="{{ url('/change-password') }}" method="POST">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <input type="password" name="old_password" class="form-control" placeholder="Enter Old Password">
                                <div class="alert-form text-danger">
                                    @if($errors->first('old_password'))
                                        {{ $errors->first('old_password') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="new_password" class="form-control" placeholder="Enter New password" required>
                                <div class="alert-form text-danger">
                                    @if($errors->first('new_password'))
                                        {{ $errors->first('new_password') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm password" required>
                                <div class="alert-form text-danger">
                                    @if($errors->first('confirm_password'))
                                        {{ $errors->first('confirm_password') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="news-letter-btn"><i class="fa fa-key"></i> Update Password</button>
                        @csrf
                    </div>
                </form>
            </div>
        </div><!-- settings end-->
    </div>
</section>

<!-- CHANGE PASSWORD START-->