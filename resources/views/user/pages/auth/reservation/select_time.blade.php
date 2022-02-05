@push('links')
<link rel="stylesheet" type="text/css" href="/common/plugins/fullcalendar/main.min.css">
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@extends('user.pages.auth.layouts.app')

@section('content')
<div class="main-container">
	<div class="pd-ltr-20">

		@include('user.pages.auth.reservation.common.steps')

		<div class="card-box pd-20 mb-30">
			<form action="{{ $page->confirmUrl() }}" method="post">
				@csrf
				<div class="d-flex mb-2">
					<input type="text" class="temp_reservation" name="temp_reservation" value="" readOnly>
					<button type="submit" class="btn btn-sm btn-primary ml-2 white-space-nowrap">確認画面へ</button>
				</div>
			</form>
			<div class="calendar-wrap">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>

{{-- くにじまテニスコートマップ用モーダル --}}
@include('user.pages.auth.include.court_map_modal')

{{-- 予約カレンダー操作方法モーダル --}}
@include('user.pages.auth.include.instructions_modal')

@endsection

@push('scripts')
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script src="/common/plugins/fullcalendar/main.min.js"></script>
<script type="text/javascript">

function zeroPadding(number){
	return ('0' + number).slice(-2);
}

$(function(){
	var input = document.querySelector('.temp_reservation');
	var tagify = new Tagify(input, {
		placeholder: '選択したコートと時間帯が表示されます（複数選択可）',
		originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','), // サーバーサイドに送信する値のフォーマット
	});
	var tempReservation = {};
	var index = 0;

	// バージョン5.5.1 プロパティの書き方が昔と異なるので注意
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'resourceTimelineDay', // 日にち表示
		locale: 'ja',
		initialDate: '{{ $page->selectedDate }}',
		height: 'auto', // カレンダーの縦スクロールバーを表示させない
		resourceAreaWidth: "16%", // resources表示幅（FullCalendar表示に対しての割合）
		resourceGroupField: 'facility', // resourcesのどのプロパティでグループ化するか
		slotMinTime: '08:00:00',
		slotMaxTime: '22:00:00',
		selectable: true, // クリック/ドラッグ&ドロップで時間選択可能にするか
		unselectAuto: false, // どこかクリックされたら選択をクリアにするか
		// 違う日付に移動した際に、resourcesを再読み込みするか
		refetchResourcesOnNavigate: false, // ※resourcesやeventsをAPIで取得する際に、表示されているカレンダーの開始日と終了日をパラメータで送る
		customButtons: {
			courtMapModalShowButton: {
				text: '施設詳細',
				click: function() {
					$('#courtMapModal').modal('show');
				}
			},
			instructionsModalShowButton: {
				text: '操作方法',
				click: function() {
					$('#instructionsModal').modal('show');
				}
			}
		},
		headerToolbar: {
			start: 'today,courtMapModalShowButton,instructionsModalShowButton', // カンマ区切り・・・ボタン隣接、スペース区切り・・・ボタン間にスペース
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
		// resourcesの項目タイトルの設定
		resourceAreaColumns: [
			{
				field: 'title',
				headerContent: '施設'
			},
		],
		// TODO: resourcesの順番をid順にしたい
		resourceOrder: '{{ implode(",", range(1, 12))}}',
		resources: [
			@foreach(range(1, 12) as $number)
			{
				id: '{{ $number }}',
				title: 'オムニコート{{ $number }}',
				facility: 'くにじまテニスコート',
			},
			@endforeach
		],
		// PHPのAPIで取得
		// resources: {
		//     url:
		//     method: 'POST'
		// }
		// イベントがすでに登録されている箇所の選択する度に呼ばれる(falseを返すと選択を許可しない)
		selectOverlap: function(event) {
			alert('他の利用者が既に予約しているので、その時間帯の施設予約はできません。');
			return false;
		},
		dateClick: function(info) {
		},
		// クリック/ドラッグ&ドロップで選択した日付の開始時間と終了時間を取得
		select: function(selectionInfo){

			// TODO: 1時間以上の利用か確認する
			var courtName = selectionInfo.resource.title;
			var start = selectionInfo.startStr;
			var end = selectionInfo.endStr;

			start = new Date(start);
			var startYear = start.getFullYear();
			var startMonth = start.getMonth() + 1;
			var startDay = start.getDate();
			var startHour = start.getHours();
			var startMinutes = zeroPadding(start.getMinutes());

			end = new Date(end);
			var endYear = end.getFullYear();
			var endMonth = end.getMonth() + 1;
			var endDay = end.getDate();
			var endHour = end.getHours();
			var endMinutes = zeroPadding(end.getMinutes());

			var startDate = startYear + '/' + startMonth + '/' + startDay;
			var endDate = endYear + '/' + endMonth + '/' + endDay;

			// TODO: 1時間単位での予約、9時半などから予約されないようチェック

			if(startDate !== endDate) {
				alert('予約開始日と終了日を同一日付にしてください');
				return false;
			}

			for(var i in tempReservation) {
				if(courtName === tempReservation[i].court_name && tempReservation[i].start <= start && end <= tempReservation[i].end){
					alert('予約希望の時間帯が重複しています');
					return false;
				}
			}

			tempReservation[index] = {
				court_name : courtName,
				start : start,
				end :  end,
			};
			var text = courtName + '：' + startDate + ' ' + startHour + ':' + startMinutes + ' 〜 ' + endDate + ' ' + endHour + ':' + endMinutes;
			tagify.addTags([text]);
			index++;
		},
	});
	calendar.render();
});
</script>
@endpush
