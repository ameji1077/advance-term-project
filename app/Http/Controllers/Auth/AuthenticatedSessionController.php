<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // 認証に成功した場合の処理
            return redirect('/');  //->intended('mypage')
        } else {
            // 認証に失敗した場合の処理
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

        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('destroyAdmin');
        $this->middleware('guest:shop-user')->except('destroyShopUser');
    }

    public function createAdmin()
    {
        return view('auth.admin-login');
    }

    public function storeAdmin(LoginRequest $request)
    {
        $request->session()->regenerateToken();
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            if ($request->user('admin')?->admin_level > 0) {
                $request->session()->regenerate();
                return redirect('/admin');
            }else {
                Auth::guard('admin')->logout();
                $request->session()->regenerate();
                return back()->withErrors([
                    'level' => 'ログインできる権限がありません',
                ]);
            }
        } else {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
        };
    }

    public function destroyAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function createShopUser()
    {
        return view('auth.shop-login');
    }

    public function storeShopUser(LoginRequest $request)
    {
        $request->session()->regenerateToken();
        $credentials = $request->only('email', 'password');
        if (Auth::guard('shop-user')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/shop-user');
        } else {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
        };
    }

    public function destroyShopUser(Request $request)
    {
        Auth::guard('shop-user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/shop-user/login');
    }
}
