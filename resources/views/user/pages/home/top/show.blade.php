@extends('user.pages.home.common.base')

@section('content')

{{-- バナー --}}
@include('user.pages.home.top.banner')
{{-- メイン --}}
@include('user.pages.home.top.main')
{{-- ログインモーダル --}}
@include('user.pages.home.modal.login')

@endsection
