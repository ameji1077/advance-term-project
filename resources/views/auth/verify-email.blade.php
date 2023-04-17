@extends('layouts.default')
<style>
.content{
    display: flex;
    justify-content: center;
    align-items: center;
}

.message-content{
    margin-top: 50px;
    padding: 50px 60px;
    width: 400px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
}

.message-content p{
    margin-bottom: 10px;
    text-align: center;
    font-size: 20px;
}

/* .message-content a{
    display: block;
    width: 100px;
    margin: 30px auto;
    text-align: center;
    line-height: 2.5;
    color: #fff;
    background: #0000ff;
    font-size: 12px;
    border-radius: 5px;
} */
</style>

<header class="header">
@include('components.header-items-2')
</header>

@section('content')
<div class="message-content">
    <p>会員登録ありがとうございます</p>
    <p>設定したメールアドレスに送信されたurlをクリックして認証をお願いします</p>
    {{-- <a href="/login">ログインする</a> --}}
</div>
@endsection










{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout> --}}
