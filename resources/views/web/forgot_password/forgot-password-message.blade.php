<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password reset</title>
    <style>
    .password_reset-forms{
        text-align: center;
    }
    .password_reset-forms  img{
        width: 200px; 
        height: 70px; 
        padding: 10px;
        border-radius: 5px;
        background-color: #555;
    }
    </style>
</head>
<body>
    <div class="password_reset-forms">
        <img src="{{ $logo }}" alt="">
        <h2 >{{ $app->app_name }}</h2>
        <h3>Reset password</h3>
        <div>
            <p>
                We received a password reset request. The link to reset your password is here bellow.<br>
                If you did not make this request please ignore this mail. This token expires after 30 minutes, Thank you.
            </p>
            <p>Here is the password reset link <a href="{{ $url }}">Reset password</a></p>
        </div>
    </div>
</body>
</html>
