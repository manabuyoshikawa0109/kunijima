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

// ログイン未
Route::group(['middleware' => 'guest:admin'], function()
{
    Route::post('login', 'LoginController@login')->name('admin.login');
});

// ログイン済み
Route::group(['middleware' => 'auth:admin'], function() {

    Route::get('top', 'TopController@show')->name('admin.top.show');

    // ログアウト
    Route::get ('logout', 'LoginController@logout')->name('admin.auth.logout');

});
