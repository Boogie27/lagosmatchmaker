

<div class="password_reset-forms" style="text-align: center;">
    <img src="{{ $message->embed('web/images/icons/logo.png') }}" alt="" style="width: 200px; height: 70px; background-color: #555;">
    <h2 >{{ $app->app_name }}</h2>
    <h3>Reset password</h3>
    <div>
        <p>We received a password reset request. The link to reset your password is here bellow.<br>
            If you did not make this request please ignore this mail. This token expires after 30 minutes, Thank you.
        </p>
        <p>Here is the password reset link <a href="{{ $url }}">Reset password</a></p>
    </div>
</div>