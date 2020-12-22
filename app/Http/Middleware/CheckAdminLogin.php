<?php

namespace App\Http\Middleware;

use App\Events\AdminAuthCheck;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckAdminLogin
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
        $ip = $request->getClientIp();
        Log::info('saaaaa');
        event(new AdminAuthCheck("کاربر با ای پی $ip وارد شد"));
        return $next($request);
    }
}
