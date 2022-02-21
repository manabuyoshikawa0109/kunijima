<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Auth;

class VariableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::shareはAuth::guard('user')->user()が使えるようになる前に実行される為、認証済みユーザーを返すとエラーになる
        // その為View::composerを使用する
        // 参考：https://biz.addisteria.com/laravel_view_share/
        View::composer('*', function ($view)  {
            $view->with('user', Auth::guard('user')->user());
        });
    }
}
