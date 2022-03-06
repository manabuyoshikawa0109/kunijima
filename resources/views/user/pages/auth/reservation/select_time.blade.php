@push('links')
<link rel="stylesheet" type="text/css" href="/common/plugins/fullcalendar/main.min.css">
<link rel="stylesheet" type="text/css" href="/common/assets/css/timeline-day.css?{{ (now())->format('Ymdhis') }}">
<style type="text/css">
.table-responsive td{
	padding: 8px 14px;
}
@media screen and (max-width: 767px) {
	.table-responsive td{
		padding: 5px 8px;
	}
}
.table-responsive th{
	background: #e1e1f5;
}
.table-responsive td:first-child, .table-responsive th:first-child {
	border-left: 1px solid #dee2e6 !important;
}
.table-responsive td:last-child, .table-responsive th:last-child {
	border-right: 1px solid #dee2e6 !important;
}
.table-responsive tbody tr{
	border-bottom: 1px solid #dee2e6 !important;
}
</style>
@endpush

@extends('user.pages.auth.layouts.app')

@section('content')
<div class="main-container">
	<div class="p-sm-3 p-1">

		@include('user.pages.auth.reservation.common.steps')

		<div class="card-box p-sm-4 px-2 py-3 mb-4">
			<form action="{{ $page->confirmUrl() }}" method="post">
				@csrf
				<div class="toolbar col-12 px-0 mb-3">
					<div class="button-group">
						<button type="button" class="btn" onclick="location.href=''">今日</button>
						<button type="button" class="btn" data-toggle="modal" data-target="#courtMapModal">マップ</button>
					</div>
					<div class="toolbar-title">
						2022年3月3日
					</div>
					<div class="button-group">
						<button disabled type="button" class="btn" onclick="location.href=''"><span class="fc-icon fc-icon-chevron-left"></span></button>
						<button type="button" class="btn" onclick="location.href=''"><span class="fc-icon fc-icon-chevron-right"></span></button>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="align-middle"><small>くにじま<br>テニスコート</small></th>
								@for ($hour = 8; $hour <= 21; $hour++)
								<th class="align-middle">{{ $hour }}時</th>
								@endfor
							</tr>
						</thead>
						<tbody>
							@for ($court = 1; $court <= 12; $court++)
							<tr>
								<td>オムニコート{{ $court }}</td>
								@for ($hour = 8; $hour <= 21; $hour++)
								<td class="text-center">
									@if($court === 1)
									<span class="icon-copy ti-close text-danger align-middle"></span>
									@else
									<div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="reservation-check-{{ $court }}-{{ $hour }}" data-court="{{ $court }}" data-hour="{{ $hour }}">
										<label class="custom-control-label" for="reservation-check-{{ $court }}-{{ $hour }}"></label>
									</div>
									@endif
								</td>
								@endfor
							</tr>
							@endfor
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>

{{--
	<button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-check-circle mr-1"></i>予約内容を確認する</button>
	<div class="table-responsive">
		<table class="table table-sm">
			<thead>
				<tr>
					<th colspan="4">2022年</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>2月22日(金)</td>
					<td>10:00 〜 11:00</td>
					<td class="text-right">オムニコート1</td>
					<td><i class="fas fa-times-circle"></i></td>
				</tr>
				<tr>
					<td>2月22日(金)</td>
					<td>10:00 〜 11:00</td>
					<td class="text-right">オムニコート1</td>
					<td><i class="fas fa-times-circle"></i></td>
				</tr>
			</tbody>
		</table>
	</div>

--}}

{{-- くにじまテニスコートマップ用モーダル --}}
@include('user.pages.auth.include.court_map_modal')

{{-- 予約カレンダー操作方法モーダル --}}
@include('user.pages.auth.include.instructions_modal')

@endsection

@push('scripts')
<script type="text/javascript">
$(function(){

});
</script>
@endpush
