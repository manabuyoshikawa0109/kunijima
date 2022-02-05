<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ModelPages\Reservation\ReservationRegisterPage;
use Carbon\Carbon;

/**
 * 施設通常予約コントローラー
 */
class ReservationController extends Controller
{
    /**
    * 通常予約 日付選択画面
    *
    * @param Request $request
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function selectDate(Request $request)
    {
        $page = $this->getReservationRegisterPage();

        return view('user.pages.auth.reservation.select_date', compact('page'));
    }

    /**
    * 通常予約 時間帯選択画面
    *
    * @param Request $request
    * @param string $date
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function selectTime(Request $request, string $date)
    {
        // TODO: 選択された日付が予約可能日かチェック必要
        $page = $this->getReservationRegisterPage($date);

        return view('user.pages.auth.reservation.select_time', compact('page'));
    }

    /**
    * 通常予約 確認画面
    *
    * @param Request $request
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function confirm(Request $request)
    {
        $page = $this->getReservationRegisterPage(null, $request->all());

        return view('user.pages.auth.reservation.confirm', compact('page'));
    }

    /**
    * 通常予約登録ページクラスを返す
    * @param string|null $date
    * @param array $input
    * @return ReservationRegisterPage
    */
    private function getReservationRegisterPage(string $date = null, array $input = [])
    {
        return new ReservationRegisterPage($date, $input);
    }
}
