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

    img{
        width: 100%;
    }

    input{
        width: 100%;
        line-height: 2;
        font-size: 16px;
        border: none;
        border-bottom: 1px solid #000;
    }

    .loginBtn{
        display: block;
        margin: 10px 25px 10px auto;
        padding: 5px;
        width: 80px;
        line-height: 2;
        color: #fff;
        background: #0000ff;
        border: none;
        border-radius: 5px;
    }

    @media screen and (max-width: 768px) {
        .form-content{
            width: 90%;
        }

        .form-content table{
            width: 90%;
        }
    }
</style>

<header class="header">
    @isset($user)
    @include('components.header-items-1')
    @else
    @include('components.header-items-2')
    @endisset
</header>

@section('content')
    <div class="login-form">
        <form method="POST" action="{{ route('login') }}" class="form-content">
            <h2 class="title">Login</h2>
            @csrf
            <table>
                <tr>
                    <th>
                        <img src="{{asset('images/mail-icon.png')}}" alt="メールアドレス">
                    </th>
                    <td>
                        <input type="text" name="email" placeholder="Email" />
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
            <button class="loginBtn">ログイン</button>
        </form>
    </div>
@endsection
