<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // ログイン済みの場合どこにリダイレクトさせるのか
        if (Auth::guard($guard)->check()) {
            if($guard === 'user'){
                return redirect(RouteServiceProvider::HOME);
            }
            if($guard === 'admin'){
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }
        }

        return $next($request);
    }
}
