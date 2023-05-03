@extends('layouts.default')
<style>
    .content{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .error-content{
        margin: 50px auto;
        padding-bottom: 10px;
        width: 450px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 2px 2px 5px #999;
    }

    .error-title{
        margin-top: 80px;
        text-align: center;
        line-height: 60px;
        font-size: 24px;
        font-weight: lighter;
        border-radius: 10px 10px 0 0;
    }

    .back-button{
        display: block;
        margin: 20px auto 80px;
        text-align: center;
        line-height: 2;
        width: 60px;
        color: #fff;
        background: #0000ff;
        border: none;
        border-radius: 5px;
    }
</style>

<header class="header">
    @include('components.header-items-1')
</header>

@section('content')
    <div class="error-content">
        <h2 class="error-title">エラーが発生しました</h2>
            <a href="/mypage" class="back-button">戻る</a>
    </div>
@endsection