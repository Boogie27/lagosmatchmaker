<!DOCTYPE html>
<html lang="en">
    <head>
        @include("admin.header.meta") <!-- meta -->
    </head>

    <body>
        
        <!-- Begin page -->
        <div id="wrapper">
            @yield("navigation")<!-- navigation -->

            @yield("content")<!-- page content -->                
        </div>
        <!-- END wrapper -->

    </body>
</html>

