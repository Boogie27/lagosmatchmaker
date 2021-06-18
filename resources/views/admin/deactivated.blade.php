
@extends("admin.layout")


@section("navigation")
    @include("admin.navigation.navigation")
    @include("admin.navigation.side-navigation")
@endsection


@section("content")
    @include("admin.deactivated.deactivated")
    @include("admin.footer.footer")
@endsection
