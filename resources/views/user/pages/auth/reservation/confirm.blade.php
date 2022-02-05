@extends('user.pages.auth.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/common/plugins/fullcalendar/main.min.css">
<style type="text/css">
.fc th{
	padding: 0 !important;
}
</style>
@endpush


@php
$user = $page->user;
@endphp

@section('content')
<div class="main-container">
	<div class="pd-ltr-20">

        @include('user.pages.auth.reservation.common.steps')

        <div class="card-box pd-20 mb-30">
			<form action="{{ $page->completeUrl() }}" method="post">
				@csrf
                <h6 class="p-2 mb-3">ご予約内容</h6>

				{{--
					@foreach($page->tempReservationInfos as $tempReservationInfo)
	                <div class="form-group detail-group row">
	                    <label class="col-sm-2 col-form-label">ご利用コート</label>
	                    <div class="col-sm-2">
	                        <span class="form-control-plaintext">{{ $tempReservationInfo['court'] }}</span>
	                    </div>
	                    <label class="col-sm-2 col-form-label">ご利用時間</label>
	                    <div class="col-sm-6">
	                        <span class="form-control-plaintext">{{ $tempReservationInfo['start'] . ' 〜 ' . $tempReservationInfo['end'] }}（{{ $tempReservationInfo['diff'] }}時間）</span>
	                    </div>
	                    <label class="col-sm-2 col-form-label">料金</label>
	                    <div class="col-sm-2">
	                        <span class="form-control-plaintext">9,000円</span>
	                    </div>
	                    <label class="col-sm-2 col-form-label">
	                        ご利用人数<br>
	                        <small class="text-muted">※入力すると1人当たりの料金が表示されます</small>
	                    </label>
	                    <div class="col-sm-2">
	                        <span class="form-control-plaintext">
	                            <div class="row align-items-end">
	                                <input type="number" class="form-control form-control-sm" name="people" value="" style="width: 80%;">
	                                <span class="ml-1">人</span>
	                            </div>
	                        </span>
	                    </div>
	                    <label class="col-sm-2 col-form-label">1人当たりの料金</label>
	                    <div class="col-sm-2">
	                        <span class="form-control-plaintext">-</span>
	                    </div>
	                </div>
					@endforeach
					--}}
				<div id="calendar"></div>

                <h6 class="p-2 mb-3">ご予約者情報</h6>
                <div class="form-group detail-group row">
                    <label class="col-sm-2 col-form-label">氏名</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->fullName() }}</span>
                    </div>
                    <label class="col-sm-2 col-form-label">氏名カナ</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->fullNameKana() }}</span>
                    </div>
                    <label class="col-sm-2 col-form-label">ニックネーム・<br>チーム名</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->nick_name }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">メールアドレス</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->email }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">電話番号</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->tel }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">生年月日</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->birthdate }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">住所</label>
                    <div class="col-sm-6">
                        <span class="form-control-plaintext">{{ $user->pref . $user->city . $user->town }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">性別</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->gender_id }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">その他連絡先</label>
                    <div class="col-sm-6">
                        <span class="form-control-plaintext">{{ $user->another_contact_info ?? '-' }}</span>
                    </div>
					<label class="col-sm-2 col-form-label">その他連絡先：<br>電話番号</label>
                    <div class="col-sm-2">
                        <span class="form-control-plaintext">{{ $user->another_tel ?? '-' }}</span>
                    </div>
                </div>
			</form>
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
		initialView: 'listYear',
		height: 'auto',
		events: [
			{
				title: 'Meeting',
				start: '2022-01-05T14:30:00',
				end: '2022-01-05T15:30:00',
				extendedProps: {
					status: 'done'
				}
			},
			{
				title: 'Meeting',
				start: '2022-01-05T14:30:00',
				end: '2022-01-05T15:30:00',
				extendedProps: {
					status: 'done'
				}
			},
			{
				title: 'Meeting',
				start: '2022-01-05T14:30:00',
				end: '2022-01-05T15:30:00',
				extendedProps: {
					status: 'done'
				}
			},
			{
				title: 'Birthday Party',
				start: '2022-01-06T07:00:00',
				backgroundColor: 'green',
				borderColor: 'green'
			}
		],
		eventDidMount: function(info) {
			if (info.event.extendedProps.status === 'done') {

				// Change background color of row
				//info.el.style.backgroundColor = 'red';

				// Change color of dot marker
				var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
				if (dotEl) {
					dotEl.style.backgroundColor = 'white';
				}
			}
		}
	});
	calendar.render();
});
</script>
@endpush

{{-- 1人当たりの料金計算JS --}}
{{-- <script type="module">
    import BigNumber from '/plugins/bignumber/bignumber.module.js';
    function changeConvertYen(e) {
        const $target = $(e.target);
        const amount = $target.val();
        const rate = $('#currency-rate .rate').text();
        const $updateTarget = $target.closest('.item-row').find('.yen');
        if ($.isNumeric(amount) && $.isNumeric(rate)) {
            let a = new BigNumber(amount);
            let r = new BigNumber(rate);
            let yen = a.multipliedBy(r);
            $updateTarget.text(yen.dp(0, BigNumber.ROUND_FLOOR).toFixed().replace( /(\d)(?=(\d\d\d)+(?!\d))/g, '$1,') + '円');
        } else {
            $updateTarget.text('-');
        }

        {{-- サマリー計算イベント発火 --}}
        $(window).trigger('calc-summary');
    }
</script> --}}
