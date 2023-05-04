@extends('layouts.default')
<style>
  .header{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .header-title{
    font-size: 32px;
  }

  .header-title a{
    text-decoration: none;
    color: black;
  }

  .logout-button{
    padding: 5px 10px;
    background: #fff;
    font-size: 20px;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
    cursor: pointer;
  }

  .reservation-content{
    margin: 100px auto;
    padding-bottom: 10px;
    width: 500px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 2px 2px 5px #999;
  }

  .reservation-content-header{
    padding: 20px;
    background: #315BFB;
    border-radius: 5px 5px 0 0;
  }

  .content-title{
    color: #fff;
    font-size: 20px;
  }

  .reservation-content table{
    display: block;
    padding: 20px 50px;
    width: 100%;
    text-align: left;
  }

  .reservation-content tr{
    height: 30px;
  }

  .reservation-content th{
    width: 30%;
    vertical-align: middle;
  }

  .reservation-content td{
    width: 70%;
    vertical-align: middle;
  }

  @media screen and (max-width:768px) {
    .reservation-content {
      width: 90%;
      max-width: 500px;
    }

    .reservation-content table{
      padding: 20px;
    }
  }
</style>

<header class="header">
  <h1 class="header-title">
    <a href="/shop-user">
      管理画面
    </a>
  </h1>
  <form action="/shop-user/logout" method="POST">
    @csrf
    <input type="submit" value="logout" class="logout-button">
  </form>
</header>

@section('content')
<div class="reservation-content">
  <div class="reservation-content-header">
    <h2 class="content-title">予約詳細</h2>
  </div>
  <table>
    <tr>
      <th>日時</th>
      <td>{{$reservation->start_at}}</td>
    </tr>
    <tr>
      <th>人数</th>
      <td>{{$reservation->num_of_users}}</td>
    </tr>
    <tr>
      <th>お名前</th>
      <td>{{$reservation->user->name}}</td>
    </tr>
    <tr>
      <th>コース</th>
      @if ($reservation->course_id !== null)
        <td>{{$reservation->course->course_name}}</td>
      @else
        <td>なし</td>
      @endif
    </tr>
  </table>
</div>
@endsection