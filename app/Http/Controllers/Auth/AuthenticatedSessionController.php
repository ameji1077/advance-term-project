<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user !== null) {
            switch ($user->user_type) {
                case 1:
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {
                        // 認証に成功した場合の処理
                        return redirect('/');  //->intended('mypage')
                    } else {
                        return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
                    }
                break;

                case 5:
                    // $request->session()->regenerateToken();
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {  //Auth::guard('shop-user')->
                        // $request->session()->regenerate();
                        return redirect('/shop-user');
                    } else {
                        return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
                    }
                break;

                case 10:
                    // $request->session()->regenerateToken();
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {   //guard('admin')->
                        // $request->session()->regenerate();
                        return redirect('/admin');
                    } else {
                        return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
                    }
                break;
            }
        } else {
            return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function __construct()
    {
        //
    }
}
