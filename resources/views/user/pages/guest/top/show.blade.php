@extends('user.pages.guest.layouts.base')

@section('content')

{{-- バナー --}}
@include('user.pages.guest.top.banner')
{{-- メイン --}}
@include('user.pages.guest.top.main')
{{-- ログインモーダル --}}
@include('user.pages.guest.modal.login')

@endsection

@push('scripts')
<script type="text/javascript">
$(function(){

  @if($errors->any())
  $('#loginModal').modal('show');
  @endif

});
</script>
@endpush
