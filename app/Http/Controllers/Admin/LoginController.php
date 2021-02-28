<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // ログイン後の遷移先
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('admin');
    }

    // ログアウト
    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect()->route('user.guest.top.show');
    }
}
