
@extends("web.layout")



@section("navigation")
    @include("web.preloader.preloader")
    @include("web.navigation.navigation")
    @include("web.navigation.side-navigation")
@endsection


@section("content")
    <agora-chat :allusers="{{ $users }}" authuserid="{{ user('id') }}" authuser="{{ user('user_name') }}"
    agora_id="{{ env('AGORA_APP_ID') }}" />
@endsection
