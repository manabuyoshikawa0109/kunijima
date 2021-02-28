<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // 未ログイン時にログイン必要な画面へアクセスした場合、どの画面へリダイレクトするのか
        if (!$request->expectsJson()) {
            return route('user.guest.top.show');
        }

        // ユーザーと管理者でリダイレクト先を変更
        // if(Route::is('user.*')){
        //     return route('user.guest.top.show');
        // }else{
        //     return route('');
        // }
    }
}
