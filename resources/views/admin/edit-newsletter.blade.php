
@extends("admin.layout")


@section("navigation")
    @include("admin.navigation.navigation")
    @include("admin.navigation.side-navigation")
@endsection


@section("content")
    @include("admin.newsletter.edit-newsletter")
    @include("admin.footer.footer")
@endsection
