
@extends("web.layout")


@section("navigation")
    @include("web.preloader.preloader")
    @include("web.navigation.side-navigation")
@endsection


@section("content")
    @include("web.error.error")
@endsection

 

 