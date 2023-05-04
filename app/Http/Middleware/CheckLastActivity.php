<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $time = 1800)
    {
        $lastActivity = session('last_activity');
        $currentTime = time();

        if ($lastActivity && ($currentTime - $lastActivity) > $time) {
            Auth::logout();
            session()->flush();
            return redirect('/login');
        }

        session(['last_activity' => $currentTime]);

        return $next($request);
    }
}
