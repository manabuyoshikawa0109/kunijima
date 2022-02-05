<?php

namespace App\Http\Middleware;

use Closure;
use App\ModelPages\Reservation\ReservationRegisterPage;

class CheckValidDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $date = $request->date;

        // 日付の形式チェック
        if(!strptime($date, '%Y-%m-%d')){
            abort(404);
        }

        list($year, $month, $day) = explode('-', $date);

        // 日付の有効性チェック
        if (!checkdate($month, $day, $year)){
            abort(404);
        }

        $page = new ReservationRegisterPage();
        
        // 予約可能な期間内か
        // if(false === in_array($date, $page->reservableDateRange(), true)){
        //     abort(404);
        // }

        return $next($request);
    }
}
