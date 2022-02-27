@push('links')
<link rel="stylesheet" type="text/css" href="/common/plugins/fullcalendar/main.min.css">
<link rel="stylesheet" type="text/css" href="/common/assets/css/fullcalendar.css?{{ (now())->format('Ymdhis') }}">
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
	background: rgba(208,208,208,.3);
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
.table-responsive td:first-child, .table-responsive td:nth-child(2), .table-responsive td:last-child{
	width: 1px;
}
</style>
@endpush

@extends('user.pages.auth.layouts.app')

@section('content')
<div class="main-container">
	<div class="p-sm-3 p-1">

		@include('user.pages.auth.reservation.common.steps')

		<div class="card-box p-sm-4 px-2 py-3 mb-4" style="border-top-left-radius: 0 !important;">
			<div class="tab">
				<ul class="nav nav-tabs customtab mb-3" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#select-time-calendar" role="tab" aria-selected="true"><span class="micon dw dw-calendar-1 mr-1"></span>カレンダー</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#reservation" role="tab" aria-selected="false"><i class="fas fa-check-circle mr-1"></i>予約内容</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade show active" id="select-time-calendar" role="tabpanel">
						<div class="calendar-wrap">
							<div id="calendar"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="reservation" role="tabpanel">
						<form action="{{ $page->confirmUrl() }}" method="post">
							@csrf
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
							<div class="mt-1">
								<button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-check-circle mr-1"></i>予約内容を確認する</button>
							</div>
						</form>
					</div>
				</div>
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
<script src="/common/plugins/fullcalendar/main.min.js"></script>
<script type="text/javascript">
function zeroPadding(number){
	return ('0' + number).slice(-2);
}

$(function(){
	var reservations = {};
	var inputs = {};
	var index = 0;
	var count = 1;

	// バージョン5.5.1 プロパティの書き方が昔と異なるので注意
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'resourceTimelineDay', // 日にち表示
		locale: 'ja',
		initialDate: '{{ $page->selectedDate }}',
		height: 'auto', // カレンダーの縦スクロールバーを表示させない
		resourceAreaWidth: "14%", // resources表示幅（FullCalendar表示に対しての割合）
		// resourceGroupField: 'facility', // resourcesのどのプロパティでグループ化するか
		slotMinTime: '08:00:00',
		slotMaxTime: '22:00:00',
		slotDuration: '01:00:00', // 時間幅
		selectable: true, // クリック/ドラッグ&ドロップで時間選択可能にするか
		unselectAuto: false, // どこかクリックされたら選択をクリアにするか
		// 違う日付に移動した際に、resourcesを再読み込みするか
		refetchResourcesOnNavigate: false, // ※resourcesやeventsをAPIで取得する際に、表示されているカレンダーの開始日と終了日をパラメータで送る
		customButtons: {
			courtMapModalShowButton: {
				text: '施設',
				click: function() {
					$('#courtMapModal').modal('show');
				}
			},
			// instructionsModalShowButton: {
			// 	text: '操作方法',
			// 	click: function() {
			// 		$('#instructionsModal').modal('show');
			// 	}
			// }
		},
		headerToolbar: {
			start: 'today,courtMapModalShowButton', // カンマ区切り・・・ボタン隣接、スペース区切り・・・ボタン間にスペース
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
				headerContent: 'くにじまテニスコート'
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

			var courtId = selectionInfo.resource.id;

			// クリック1回目：開始時間の値のみ取得
			if(count === 1){
				var start = selectionInfo.startStr;
				// inputの値
				start = moment(start).format('YYYY-MM-DD HH:mm');

				// バリデーション用の値
				var startDate = moment(start).format('YYYY-MM-DD');

				// 表示用の値
				var courtName = selectionInfo.resource.title;
				var year = moment(start).format('YYYY年');
				var monthDay = moment(start).format('M月D日');
				var startTime = moment(start).format('h:mm');
				// 2回目のクリックに備えて一時退避
				inputs = {
					court_id : courtId,
					court_name : courtName,
					start : start,
					startDate : startDate,
					year : year,
					monthDay : monthDay,
					startTime : startTime,
				};
				count++;
				return;
			}

			if(count === 2){
				// 開始時間と終了時間のコートが同じか確認
				if(inputs.court_id !== courtId){
					alert('同じコートを選択してください。')
					inputs = {};
					count = 1;
					return;
				}
				var end = selectionInfo.endStr;

				// inputの値
				end = moment(end).format('YYYY-MM-DD HH:mm');

				// バリデーション用の値
				var endDate = moment(end).format('YYYY-MM-DD');

				if(inputs.startDate !== endDate) {
					alert('同じ日付を選択してしてください');
					inputs = {};
					count = 1;
					return false;
				}

				// 表示用の値
				var endTime = moment(end).format('h:mm');

				// 入力値
				var test1 = '<input type="hidden" name="court_id" value="' + courtId + '">';
				var test2 = '<input type="hidden" name="start" value="' + inputs.start + '">';
				var test3 = '<input type="hidden" name="end" value="' + end + '">';
				console.log(test1);
				console.log(test2);
				console.log(test3);
				var time = inputs.startTime + ' 〜 ' + endTime;
				console.log(time);
				inputs = {};
				count = 1;
			}

			// for(var i in reservations) {
			// 	if(courtId === reservations[i].court_id && reservations[i].start <= start && end <= reservations[i].end){
			// 		alert('予約希望の時間帯が重複しています');
			// 		return false;
			// 	}
			// }
			//
			// reservations[index] = {
			//
			// };
			// index++;
		},
	});
	calendar.render();
});
</script>
@endpush
