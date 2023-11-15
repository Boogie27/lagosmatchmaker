<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf_token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta property="og:url" content="{{ current_url() }}">
<meta property="og:title" content="{{ settings()->app_name }}">
<meta name="description" content="Privacy is our policy">
<meta property="og:image" content="{{ asset('web/images/icons/icon.ico') }}" href="{{ asset('web/images/icons/icon.ico') }}">
<title>{{ settings()->app_name }}</title>

<link rel="shortcut icon" href="{{ asset('web/images/icons/icon.ico') }}">

<link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('web/font-awesome/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('web/css/bootstrap-select.min.css') }}">

<link rel="stylesheet" href="{{ asset('web/css/style.css') }}"><!-- app css -->

<script src="{{ asset('web/js/jquery-3.5.1.js') }}"></script> <!-- jquery script -->

<!-- real time chat socket.io CDN -->
<script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>



<link href="{{ asset('cropper/cropper.min.css') }}" rel="stylesheet" type="text/css" /> <!-- cropper css-->
<script src="{{ asset('cropper/cropper.min.js') }}" type="text/javascript"></script> <!-- cropper js-->


</head>
<body>
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-8">
                    <div class="text-center">
                    <div>
                            <img src="{{ asset('admins/images/banner/error.jpg') }}" alt="" class="img-fluid" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <div class="title-header text-center">
                        <h3 class="user-display-name">Oops, Page Expired</h3>
                    </div>
                    <!-- <h3 class="mt-3">We couldn’t connect the dots</h3>
                    <p class="text-muted mb-5"></p> -->

                    <a href="{{ url('/') }}" class="error-btn btn btn-lg  mt-4">Take me back to Home</a>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end account-pages -->

</body>
</html>





<!-- TN250390M -->