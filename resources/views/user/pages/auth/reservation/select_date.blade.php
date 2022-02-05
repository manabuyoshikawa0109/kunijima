@push('links')
<link rel="stylesheet" type="text/css" href="/common/plugins/fullcalendar/main.min.css">
@endpush

@extends('user.pages.auth.layouts.app')

@section('content')
<div class="main-container">
	<div class="pd-ltr-20">

		@include('user.pages.auth.reservation.common.steps')

		<div class="card-box pd-20 mb-30">
			<div class="calendar-wrap">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="/common/plugins/fullcalendar/main.min.js"></script>
<script type="text/javascript">
$(function(){
	// バージョン5.5.1 プロパティの書き方が昔と異なるので注意
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth', // 月表示
		locale: 'ja',
		height: 'auto', // カレンダーの縦スクロールバーを表示させない
		headerToolbar: {
			start: 'today',
			center: 'title',
			end: 'prev,next'
		},
		buttonText: {
			today: '今日',
		},
		validRange: {
            start: '{{ $page->reservableFirstDay() }}',
            end: '{{ $page->reservableLastDay() }}',
        },
		events: [
			@foreach ($page->reservableDateRange() as $date)
			{
				start: '{{ $date->format('Y-m-d') }}',
				display: 'background',
				color: '{{ $page->dateBackgroundColor($date) }}',
			},
	        @endforeach
		],
		dateClick: function(dateClickInfo) {
			dateClickInfo.dayEl.style.backgroundColor = '{{ $page::SELECTED_DATE_BACKGROUND_COLOR }}'; // 選択された日付の色を変更
			// 選択された日付を取得
			var date = dateClickInfo.dateStr;
			var baseUrl = '{{ $page->selectTimeUrl() }}';
			var url = baseUrl.replace('{{ $page->today() }}', date);
			// 選択された日付のカレンダーへ遷移
			window.location.href = url;
		},
	});
	calendar.render();
});
</script>
@endpush
