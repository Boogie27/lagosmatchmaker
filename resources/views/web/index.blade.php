
@extends("web.layout")


@section("navigation")
    @include("web.preloader.preloader")
    @include("web.navigation.navigation")
    @include("web.navigation.side-navigation")
     <!-- slider page is here -->
@endsection


@section("content")
    @include("web.index.index")
    @include("web.footer.footer") <!-- footer -->
@endsection

 