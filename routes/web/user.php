<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.pages.guest.top.show');
})->name('user.guest.top.show');

Route::get('/login', function () {
    return view('user.pages.guest.top.show');
})->name('user.guest.top.login');

// ログイン未
Route::group(['middleware' => 'guest:user'], function()
{
    Route::post('login', 'LoginController@login')->name('user.guest.login');
});

// ログイン済み
Route::group(['middleware' => 'auth:user'], function() {

    Route::get ('top', 'TopController@show')->name('user.auth.top.show');

    Route::get ('reservation/date', 'ReservationController@selectDate')->name('user.auth.reservation.select.date');
    Route::get ('reservation/{date}/time', 'ReservationController@selectTime')->name('user.auth.reservation.select.time')->middleware('date.check');
    Route::post('reservation/confirm', 'ReservationController@confirm')->name('user.auth.reservation.confirm');
    Route::post('reservation/complete', 'ReservationController@complete')->name('user.auth.reservation.complete');

    Route::get ('user/detail', 'UserController@detail')->name('user.auth.user.detail');
    Route::get ('user/edit',   'UserController@edit')->name('user.auth.user.edit');

    // TODO: 予約状況の確認はFullCalendarのリストビュー状にしたい
    // https://fullcalendar.io/docs/list-view

    Route::any ('sql/insert',  'SqlController@insert')->name('user.auth.sql.insert');

    // ログアウト
    Route::get ('logout', 'LoginController@logout')->name('user.auth.logout');

});
