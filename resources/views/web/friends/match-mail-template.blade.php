<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $app->app_name }}</title>
    <style>
        *{
            padding: 0px;
            margin: 0px;
        }
        body{
            padding: 0px;
            margin: 0px;
            font-size: 1rem;
            font-weight: 400;
            color: #555;
            text-align: left;
        }
        .color{
            color: orange;
        }
        h1, h2, h3, h4, h5, h6, p, li, a{
            font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
            margin: 0px;
        }
        p{
            padding: 0px;
            margin: 0px;
        }
        .container{
            padding: 20px;
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
        }
        .page-img {
            width: 200px;
            height: 60px;
            margin: 0 auto;
        }
        .page-img img{
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            background-color: #333;
        }
        .title-header{
            margin: 40px 0px;
            font-size: 20px;
            color: #555;
        }
        .title-header h4{
            font-size: 18px;
        }
        .text-center{
            text-align: center;
        }
        .page-body{
            text-align: center;
            padding: 50px 0px;
        }
        .page-body p{
            padding: 0px;
            font-size: 12px;
        }
        .message{
            margin-top: 30px;
            padding: 20px;
        }
        .message p{
            font-size: 12px;
            margin: 5px 0px;
        }
        .footer-top{
            width: 80%;
            margin: 0 auto;
        }
        .footer-top ul li{
            font-size: 12px;
            margin: 7px 0px;
            color: #555;
        }
        .footer ul{
            list-style: none;
            padding: 0px;
        }
        .footer-top ul li.footer-top-head h4{
            font-weight: 600;
            font-size: 15px;
            color: #555;
        }
        .footer-bottom{
            color: #fff;
            padding: 20px;
            font-size: 13px;
            text-align: center;
            background-color: rgb(15, 15, 15);
        }
        @media only screen and (max-width: 1125px){
            .container, .footer-top{
                width: 90%;
            }
            .footer-top ul{
                padding: 0px 10px;
            }
            .page-body{
                padding-left: 10px;
                padding-right: 10px;
            }
        }
        @media only screen and (max-width: 992px){
            .container, .footer-top{
                width: 95%;
                margin: 0px;
            }
        }
        @media only screen and (max-width: 992px){
            .container, .footer-top{
                width: 100%;
                margin: 0px;
                padding: 0px;
            }
            .container{
                padding-top: 30px;
            }
            .page-img {
                width: 100%;
                text-align: center;
            }
            .page-img img{
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-img">
            <img src="{{ $logo }}" alt="">
        </div>
        <div class="page-body">
           <p>{{ $match_message }}</p>
           <span>Click <a href="{{ $url }}"><b>here</b></a> to see and chat with your match.</span>
        </div>
    </div>

    <!-- FOOTER START -->
    <div class="footer">
        <div class="footer-top">
            <ul>
                <li class="footer-top-head"><h4>{{ $app->app_name }}</h4></li>
                <li>Email: <a href="mailto:{{ $app->email }}" class="color">{{ $app->email }}</a></li>
                <li>Telelphone: <a href="tel:{{ $app->phone }}"></a>{{ $app->phone }}</li>
                <li></li>
            </ul>
            <div class="message text-center">
                <p>
                    You are receiving this email because you are a registered members of Lagosmatchmaker.
                </p>
                <p>
                    If you are receiving this by error please ignore or delete this mail.
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-rights"><p>{{ $app->copyright }}</p></div>
        </div>
    </div>
    <!-- FOOTER END -->
</body>
</html>