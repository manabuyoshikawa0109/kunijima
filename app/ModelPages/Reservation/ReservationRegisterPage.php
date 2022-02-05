<?php
namespace App\ModelPages\Reservation;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Auth;
use App\Models\User;

/**
* 施設通常予約登録ページ専用クラス
*/
class ReservationRegisterPage
{
    // 抽選予約の締め切り日
    const DRAWING_RESERVATION_DEADLINE = 11;
    // 翌月
    const NEXT_MONTH = 1;
    // 翌々月
    const MONTH_AFTER_NEXT = 2;

    const SELECTED_DATE_BACKGROUND_COLOR = '#e0deef';

    const TIME_FORMAT = 'Y年n月j日 g:i';

    /** @var string|null 選択された日付 */
    public $selectedDate = null;

    /** @var array テニスコート仮予約情報 */
    public $tempReservationInfos = null;

    /**
    * 初期化
    * @param string|null $date
    * @param array $input
    */
    public function __construct(string $date = null, array $input = [])
    {
        $this->selectedDate = $date;

        $tempReservation = Arr::get($input, 'temp_reservation');
        $tempReservationInfos = $tempReservation ? explode(',', $tempReservation) : [];

        foreach ($tempReservationInfos as $tempReservationInfo) {
            list($court, $time) = explode('：', $tempReservationInfo);
            list($start, $end) = explode('〜', $time);

            $start = Carbon::parse($start);
            $end = Carbon::parse($end);

            $array = [
                'start' => $start->format(self::TIME_FORMAT),
                'end' => $end->format(self::TIME_FORMAT),
                'diff' => $start->diffInHours($end),
                'court' => $court,
            ];

            info($array);

            $this->tempReservationInfos[] = [
                'start' => $start->format(self::TIME_FORMAT),
                'end' => $end->format(self::TIME_FORMAT),
                'diff' => $start->diffInHours($end),
                'court' => $court,
            ];
        }
        info(User::all());

        $this->user = Auth::guard('user')->user();
        foreach (collect([$this->user]) as $key => $value) {
            info($value);
        }
    }

    /**
    * 今日の日付を取得
    *
    * @param string $format
    * @return string
    */
    public function today(string $format = 'Y-m-d')
    {
        return (Carbon::today())->format($format);
    }

    /**
    * 予約可能な一番最初の日付(=今日)を取得
    *
    * @param string $format
    * @return string
    */
    public function reservableFirstDay(string $format = 'Y-m-d')
    {
        return $this->today($format);
    }

    /**
    * 予約可能な一番最後の日付(=翌月か翌々月の月末)を取得
    *
    * @param string $format
    * @return string
    */
    public function reservableLastDay(string $format = 'Y-m-d')
    {
        $reservableDateRange = $this->reservableDateRange();

        return $reservableDateRange->last()->format($format);
    }

    /**
    * 予約可能な日付範囲を配列で取得
    *
    * @return array
    */
    public function reservableDateRange()
    {
        $today = Carbon::today();

        if($today->day <= self::DRAWING_RESERVATION_DEADLINE){
            // 抽選予約が終わる11日以前(11日を含む)の場合、翌月末まで
            $month = self::NEXT_MONTH;
        }else{
            // 抽選予約が終わっている12日以降は、翌々月末まで
            $month = self::MONTH_AFTER_NEXT;
        }

        $end = $today->copy()->addMonthsNoOverflow($month)->lastOfMonth();

        return CarbonPeriod::create($today->format('Y-m-d'), $end->format('Y-m-d'));
    }

    /**
    * 祝日判定
    *
    * @param Carbon $date
    * @return boolean
    */
    public function isHoliday(Carbon $date)
    {
        return in_array((string)$date->day, config("holiday.holiday.{$date->year}.{$date->month}"), true);
    }

    /**
    * 日付の背景色を取得
    * 日曜・祝日・・・ピンク色
    * 土曜日・・・青色
    * 平日・・・白色
    *
    * @param Carbon $date
    * @return string
    */
    public function dateBackgroundColor(Carbon $date)
    {
        if($date->isSunday() || $this->isHoliday($date)){
            return config('holiday.backgroundcolor.sunday');
        }

        if($date->isSaturday()){
            return config('holiday.backgroundcolor.saturday');
        }

        return config('holiday.backgroundcolor.weekday');
    }

    /**
    * 日付選択画面を開いているか
    *
    * @return boolean
    */
    public function isSelectingDate()
    {
        return Route::currentRouteName() === 'user.auth.reservation.select.date';
    }

    /**
    * 時間帯選択画面を開いているか
    *
    * @return boolean
    */
    public function isSelectingTime()
    {
        return Route::currentRouteName() === 'user.auth.reservation.select.time';
    }

    /**
    * 確認画面を開いているか
    *
    * @return boolean
    */
    public function isConfirming()
    {
        return Route::currentRouteName() === 'user.auth.reservation.confirm';
    }

    /**
    * 完了画面を開いているか
    *
    * @return boolean
    */
    public function isCompleted()
    {
        return Route::currentRouteName() === 'user.auth.reservation.complete';
    }

    /**
    * ステップ毎にユーザーへ行って欲しいアクションのメッセージを返す
    *
    * @return string
    */
    public function guideMessage()
    {
        if($this->isCompleted()){
            return '4.予約手続き完了';
        }
        if($this->isConfirming()){
            return '3.予約内容をご確認ください';
        }
        if($this->isSelectingTime()){
            return '2.予約希望の時間帯を選択してください';
        }

        return '1.予約希望の日付を選択してください';
    }

    /**
    * 時間帯選択画面へ遷移するURLを返す
    *
    * @return string
    */
    public function selectTimeUrl()
    {
        return route('user.auth.reservation.select.time', ['date' => $this->today() ]);
    }

    /**
    * 確認画面へ遷移するURLを返す
    *
    * @return string
    */
    public function confirmUrl()
    {
        return route('user.auth.reservation.confirm');
    }

    /**
    * 完了画面へ遷移するURLを返す
    *
    * @return string
    */
    public function completeUrl()
    {
        return route('user.auth.reservation.complete');
    }
}
