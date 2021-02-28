@extends('user.pages.auth.layouts.base')

@section('inner_body')
    {{-- ヘッダー --}}
    @include('user.pages.auth.common.header')

    {{-- サイドバー --}}
    @include('user.pages.auth.common.nav')

    {{-- 各ページのコンテンツ --}}
    @yield('content')
@endsection
