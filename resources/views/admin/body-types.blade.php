
@extends("admin.layout")


@section("navigation")
    @include("admin.navigation.navigation")
    @include("admin.navigation.side-navigation")
@endsection


@section("content")
    @include("admin.options.body-type")
    @include("admin.footer.footer")
@endsection
