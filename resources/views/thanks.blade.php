@extends('layouts.default')
<style>
  .content{
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .message-content{
    margin-top: 50px;
    padding: 50px 0;
    width: 400px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .message-content p{
    text-align: center;
    font-size: 20px;
  }

  .message-content a{
    display: block;
    width: 100px;
    margin: 30px auto;
    text-align: center;
    line-height: 2.5;
    color: #fff;
    background: #0000ff;
    font-size: 12px;
    border-radius: 5px;
  }
</style>

<header class="header">
  @include('components.header-items-2')
</header>

@section('content')
  <div class="message-content">
    <p>会員登録ありがとうございます</p>
    <a href="/login">ログインする</a>
  </div>
@endsection