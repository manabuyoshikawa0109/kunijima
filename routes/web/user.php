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

    Route::get('top', 'TopController@show')->name('user.auth.top.show');

    // ログアウト
    Route::get ('logout', 'LoginController@logout')->name('user.auth.logout');

});
