
@extends("web.layout")


@section("navigation")
    @include("web.preloader.preloader")
    @include("web.navigation.navigation")
    @include("web.navigation.side-navigation")
@endsection


@section("content")
    @include("web.message.message")
    @include("web.footer.footer") <!-- footer -->
@endsection

 