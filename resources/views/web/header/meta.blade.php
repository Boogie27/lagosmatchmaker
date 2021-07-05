<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf_token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ title() }}</title>

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


<script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.3.1.js"></script> <!-- Agora call --> 