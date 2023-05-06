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
</style>

<header class="header">
@include('components.header-items-2')
</header>

@section('content')
<div class="message-content">
    <p>会員登録ありがとうございます</p>
    <p>設定したメールアドレスに送信されたurlをクリックして認証をお願いします</p>
</div>
@endsection
