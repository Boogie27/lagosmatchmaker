<!DOCTYPE html>
<html lang="en">
    <head>
        @include("admin.header.meta") <!-- meta -->
    </head>

    <body>
        
        <!-- Begin page -->
        <div id="wrapper">
            @include("admin.preloader") <!-- meta -->
            @include("admin.modal-popup") <!-- modal popup -->

            @yield("navigation")<!-- navigation -->

            @yield("content")<!-- page content -->   
            @include("admin.script") <!-- javascript  -->             
        </div>
        <!-- END wrapper -->
    </body>
</html>

