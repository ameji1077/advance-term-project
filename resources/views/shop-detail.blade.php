@extends('layouts.default')
<style>
  .shop-wrapper{
    display: flex;
    justify-content: space-between;
  }

  .shop-detail-card{
    width: 45%;
  }

  .shop-name-box{
    display: flex;
    align-items: center;
    margin-top: 30px;
  }

  .back-btn{
    margin-right: 10px;
    padding: 5px 10px;
    color: black;
    background: #fff;
    border-radius: 5px;
    box-shadow: 2px 2px 2px #999;
  }

  .shop-name{
    font-size: 28px;
  }

  .shop-img{
    margin-top: 30px;
  }

  .shop-img img{
    width: 100%;
  }

  .shop-detail{
    margin-top: 30px;
  }

  .shop-description{
    margin-top: 30px;
    line-height: 1.5;
  }

  .reservation-form{
    position: absolute;
    top: 30px;
    right: 100px;
    padding: 30px;
    width: 35%;
    height: 80%;
    background: #315BFB;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .reservation-title{
    font-size: 24px;
    color: #fff;
  }

  .input-date{
    margin-top: 20px;
    width: 150px;
    line-height: 2;
    border: none;
    border-radius: 5px;
  }

  .input-time{
    margin-top: 10px;
    width: 95%!important;
    height: 30px;
    border: none;
    border-radius: 5px;
  }

  .input-number{
    margin-top: 10px;
    width: 95%!important;
    height: 30px;
    border: none;
    border-radius: 5px;
  }

  .error-message{
    margin: 5px 0px 10px;
    color: #ff0000;
  }

  .reservation-form table{
    margin-top: 20px;
    width: 90%;
    color: #fff;
    background: #4D7EFB;
    border-radius: 5px;
  }

  .reservation-form tr{
    margin-left: 10px;
    font-size: 12px;
    line-height: 2;
    font-weight: bold;
  }

  .reservation-form th{
    padding-left: 20px;
    width: 100px;
    text-align: left;
  }

  .reservation-form tr:first-of-type th{
    padding-top: 20px;
  }

  .reservation-form tr:last-of-type th{
    padding-bottom: 20px;
  }

  .reservation-form td{
    text-align: left;
  }

  .reservation-button{
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 4;
    color: #fff;
    background: #184AFB;
    font-weight: bold;
    border: none;
    border-radius: 0 0 5px 5px;
    cursor: pointer;
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
  <div class="shop-wrapper">
    <div class="shop-detail-card">
      <div class="shop-name-box">
        <a href="javascript:history.back()" class="back-btn">&lt;</a>
        <h2 class="shop-name">{{$shop->name}}</h2>
      </div>
      <div class="shop-img">
        <img src="{{$shop->image_url}}" alt="ショップイメージ">
      </div>
      <p class="shop-detail">#{{$shop->area->name}} #{{$shop->genre->name}}</p>
      <p class="shop-description">{{$shop->description}}</p>
    </div>
    <form action="/reserve" method="POST" class="reservation-form" id="reservationForm">
      @csrf
      <h2 class="reservation-title">予約</h2>
      <input type="hidden" name="shop_id" value="{{$shop->id}}">
      <input type="date" name="date" class="input-date" id="date" onkeydown="return false">
      @error('date')
        <p class="error-message">{{$message}}</p>
      @enderror
      <select name="time" class="input-time" id="time">
        <?php
          $start_time = strtotime("00:00");
          $end_time = strtotime("23:45");
          $interval = 15 * 60; // 15分を秒に変換

          for ($i = $start_time; $i <= $end_time; $i += $interval) {
            $time = date("H:i", $i);
            echo "<option value=\"$time\">$time</option>";
          }
        ?>
      </select>
      @error('time')
        <p class="error-message">{{$message}}</p>
      @enderror
      <select name="num_of_users" class="input-number" id="number">
        @for ($i = 1; $i <= 20; $i++)
        echo '<option value={{$i}}>{{$i}}人</option>'
        @endfor
      </select>
      @error('num_of_users')
        <p class="error-message">{{$message}}</p>
      @enderror
      <table>
        <tr>
          <th>Shop</th>
          <td>{{$shop->name}}</td>
        </tr>
        <tr>
          <th>Date</th>
          <td id="dateResult"></td>
        </tr>
        <tr>
          <th>Time</th>
          <td id="timeResult">00:00</td>
        </tr>
        <tr>
          <th>Number</th>
          <td id="numberResult">1人</td>
        </tr>
      </table>
      <button class="reservation-button">予約する</button>
    </form>
  </div>
  <script src="{{asset('/js/main.js')}}"></script>
@endsection
