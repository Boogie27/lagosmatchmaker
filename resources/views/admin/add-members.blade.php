
@extends("admin.layout")


@section("navigation")
    @include("admin.navigation.navigation")
    @include("admin.navigation.side-navigation")
@endsection


@section("content")
    @include("admin.add_members.add-members")
    @include("admin.footer.footer")
@endsection
