@extends('layouts.default')
<style>
    .content{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-content{
        margin: 100px auto;
        padding-bottom: 10px;
        width: 500px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 2px 2px 5px #999;
    }

    .form-content .title{
        padding-left: 5%;
        height: 60px;
        line-height: 60px;
        font-size: 20px;
        color: #fff;
        background: #0000ff;
        border-radius: 10px 10px 0 0;
    }

    .form-content table{
        margin: 20px 25px 10px;
        width: 450px;
        border-collapse: separate;
        border-spacing: 10px;
    }

    table tr{
        width: 100%;
        height: 20px;
    }

    table th{
        width: 10%;
    }
    
    table td{
        vertical-align: middle;
        width: 90%;
    }

    .error-message{
        width: 90%;
        font-size: 12px;
        color: red;
    }

    .error-message td{
        height: 30px;
        vertical-align: top;
    }

    table img{
        width: 100%;
    }

    input{
        width: 100%;
        line-height: 2;
        font-size: 16px;
        border: none;
        border-bottom: 1px solid #000;
    }

    .registerBtn{
        display: block;
        margin: 10px 25px 10px auto;
        padding: 5px;
        width: 60px;
        line-height: 2;
        color: #fff;
        background: #0000ff;
        border: none;
        border-radius: 5px;
    }
</style>

<header class="header">
    @include('components.header-items-2')
</header>

@section('content')
<div>
    <form method="POST" action="{{ route('register') }}" class="form-content">
        <h2 class="title">Registration</h2>
        @csrf
        <table>
            
            <tr>
                <th>
                    <img src="{{asset('images/user-icon.png')}}" alt="ユーザー">
                </th>
                <td>
                    <input type="text" name="name" :value="old('name')" autofocus placeholder="Username" />
                </td>
            </tr>
            @error('name')
            <tr class="error-message">
                <th></th>
                <td>{{$message}}</td>
            </tr>
            @enderror
            <tr>
                <th>
                    <img src="{{asset('images/mail-icon.png')}}" alt="メールアドレス">
                </th>
                <td>
                    <input type="text" name="email" :value="old('email')" placeholder="Email" />
                </td>
            </tr>
            @error('email')
            <tr class="error-message">
                <th></th>
                <td>{{$message}}</td>
            </tr>
            @enderror
            <tr>
                <th>
                    <img src="{{asset('images/key-icon.png')}}" alt="パスワード">
                </th>
                <td>
                    <input type="password" name="password" placeholder="Password" />
                </td>
            </tr>
            @error('password')
            <tr class="error-message">
                <th></th>
                <td>{{$message}}</td>
            </tr>
            @enderror
        </table>
        <button class="registerBtn">登録</button>
    </form>
</div>
@endsection



































{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
