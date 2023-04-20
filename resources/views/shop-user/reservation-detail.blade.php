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

  .logout-button{
    padding: 5px 10px;
    background: #fff;
    font-size: 20px;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
    cursor: pointer;
  }
</style>

<header class="header">
  <h1 class="header-title">管理画面</h1>
  <form action="/shop-user/logout" method="POST">
    @csrf
    <input type="submit" value="logout" class="logout-button">
  </form>
</header>

@section('content')
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
</table>
@endsection