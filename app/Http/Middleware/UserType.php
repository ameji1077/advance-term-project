<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$userTypes)
    {
        $userType = $request->user()->user_type;
        switch ($userType) {
            case 1:
                $userTypeString = 'user';
                break;
            case 5:
                $userTypeString = 'shop-user';
                break;
            case 10:
                $userTypeString = 'admin';
                break;
        };
        if (!in_array($userTypeString, $userTypes)) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
