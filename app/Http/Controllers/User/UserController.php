<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * 利用者情報詳細画面
    *
    * @param Request $request
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function detail(Request $request)
    {
        return view('user.pages.auth.user.detail');
    }
}
