
@extends("admin.layout")


@section("navigation")
    @include("admin.navigation.navigation")
    @include("admin.navigation.side-navigation")
@endsection


@section("content")
    @include("admin.how_it_works.how-it-works")
    @include("admin.footer.footer")
@endsection
