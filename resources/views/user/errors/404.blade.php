@extends('user.pages.auth.layouts.base')



@section('inner_body')
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-4 d-block">404</span>
                <div class="mb-4 lead">お探しのページが存在しません。URLをご確認ください。</div>
                <div class="lead"><a href="{{ route('admin.top') }}">トップへ戻る</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
