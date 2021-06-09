<!DOCTYPE html>
<html lang="en">
<head>
    @include("web.header.meta") <!-- meta -->
</head>
<body>
    @include('web/modal_popup/modal-popup')
    @yield("navigation")<!-- navigation -->

    @yield("content")<!-- page content -->
</body>
</html>

