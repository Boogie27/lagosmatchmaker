
@extends("web.layout")


@section("navigation")
    @include("web.preloader.preloader")
    @include("web.navigation.navigation")
    @include("web.navigation.side-navigation")
@endsection


@section("content")
    @include("web.basic.basic")
    @include("web.footer.footer") <!-- footer -->
@endsection

 