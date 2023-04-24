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

  .tab {
    margin: 100px auto;
    width: 600px;
  }

  .tab-menu {
    display: flex;
    padding-left: 10px;
  }

  .tab-menu__item {
    text-align: center;
    padding: 10px 0;
    cursor: pointer;
    list-style: none;
    width: 100px;
    background: #fff;
    border-top: 1px solid #315BFB;
    border-left: 1px solid #315BFB;
    border-right: 1px solid #315BFB;
  }

  .tab-menu__item:not(:first-child) {
    border-left: none;
  }

  .tab-menu__item.active {
    background: #315BFB;
    color: #fff;
  }

  .tab-content {
    background: #fff;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .tab-content__item {
    display: none;
  }

  .tab-content__item.show {
    display: block;
  }

  .tab-content-header{
    padding: 20px;
    background: #315BFB;
    border-radius: 5px 5px 0 0;
  }

  .content-title{
    color: #fff;
    font-size: 20px;
  }

  .shop-form{
    padding: 20px;
  }

  .shop-form table{
    width: 100%;
    text-align: left;
  }

  .shop-form tr{
    height: 50px;
  }

  .shop-form tr:nth-of-type(4){
    height: 100px;
  }

  .shop-form th{
    width: 30%;
    vertical-align: middle;
  }

  .shop-form td{
    width: 70%;
    vertical-align: middle;
  }

  .shop-form input,
  .shop-form select,
  .shop-form textarea{
    width: 100%;
  }

  .shop-form input,
  .shop-form select{
    height: 30px;
  }

  .shop-form textarea{
    height: 80px;
  }

  .shop-button{
    display: block;
    margin-left: auto;
    padding: 10px 20px;
    color: #fff;
    background: #315BFB;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .reservation-list{
    padding: 20px;
  }

  .reservation-list table{
    width: 100%;
  }

  .reservation-list tr{
    height: 50px;
  }

  .reservation-list th:nth-of-type(1){
    width: 30%
  }

  .reservation-list th:nth-of-type(2){
    width: 30%
  }

  .reservation-list th:nth-of-type(3){
    width: 20%;
  }

  .reservation-list th:nth-of-type(4){
    width: 20%;
  }

  @media screen and (max-width: 768px) {
    .tab{
      width: 90%;
    }
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
<div class="tab">
  <ul class="tab-menu">
    @unless ($shop)
    <li class="tab-menu__item">作成</li>
    @endunless
    @if ($shop)
    <li class="tab-menu__item">更新</li>
    @endif
    <li class="tab-menu__item active">予約</li>
  </ul>
  <div class="tab-content">
    @unless ($shop)
    <div class="tab-content__item">
      <div class="tab-content-header">
        <h2 class="content-title">店舗作成</h2>
      </div>
      <form action="/shop-user/shop/create" method="POST" class="shop-form">
        @csrf
        <input type="hidden" name="shop_user_id" value="{{$user->id}}">
        <table>
          @error('name')
            <tr>
              <th></th>
              <td>{{$message}}</td>
            </tr>
          @enderror
          <tr>
            <th>店舗名</th>
            <td>
              <input type="text" name="name">
            </td>
          </tr>
          @error('area_id')
            <tr>
              <th></th>
              <td>{{$message}}</td>
            </tr>
          @enderror
          <tr>
            <th>エリア名</th>
            <td>
              <select name="area_id">
                @foreach ($areas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          @error('genre_id')
            <tr>
              <th></th>
              <td>{{$message}}</td>
            </tr>
          @enderror
          <tr>
            <th>ジャンル名</th>
            <td>
              <select name="genre_id">
                @foreach ($genres as $genre)
                  <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          @error('description')
            <tr>
              <th></th>
              <td>{{$message}}</td>
            </tr>
          @enderror
          <tr>
            <th>説明文</th>
            <td>
              <textarea name="description"></textarea>
            </td>
          </tr>
          @error('image_url')
            <tr>
              <th></th>
              <td>{{$message}}</td>
            </tr>
          @enderror
          <tr>
            <th>トップ画像</th>
            <td>
              <input type="file" name="image_url">
            </td>
          </tr>
      </table>
      <button class="shop-button">作成</button>
      </form>
    </div>
    @endunless
    @if ($shop)
    <div class="tab-content__item">
      <div class="tab-content-header">
        <h2 class="content-title">店舗更新</h2>
      </div>
      <form action="/shop-user/shop/update" method="POST" class="shop-form">
        @csrf
        <input type="hidden" name="id" value="{{$shop->id}}">
        <input type="hidden" name="shop_user_id" value="{{$user->id}}">
        <table>
          <tr>
            <th>店舗名</th>
            <td>
              <input type="text" name="name" value="{{$shop->name}}">
            </td>
          </tr>
          <tr>
            <th>エリア名</th>
            <td>
              <select name="area_id">
                <option value="{{$shop->area->id}}" selected>{{$shop->area->name}}</option>
                @foreach ($areas as $area)
                  <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <th>ジャンル名</th>
            <td>
              <select name="genre_id">
                <option value="{{$shop->genre->id}}" selected>{{$shop->genre->name}}</option>
                @foreach ($genres as $genre)
                  <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <th>説明文</th>
            <td>
              <textarea name="description">{{$shop->description}}</textarea>
            </td>
          </tr>
          <tr>
            <th>トップ画像</th>
            <td>
              <input type="file" name="image_url" value="">
            </td>
          </tr>
      </table>
      <button class="shop-button">更新</button>
      </form>
    </div>
    @endif
    <div class="tab-content__item show">
      <div class="tab-content-header">
        <h2 class="content-title">予約状況</h2>
      </div>
      <div class="reservation-list">
        <table>
          <tr>
            <th>日時</th>
            <th>人数</th>
            <th>お名前</th>
            <th>詳細</th>
          </tr>
          @foreach ($reservations as $reservation)
            <tr>
              <td>{{$reservation->start_at}}</td>
              <td>{{$reservation->num_of_users}}</td>
              <td>{{$reservation->user->name}}</td>
              <td><a href="/shop-user/{{$reservation->id}}">詳細</a></td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  const tabs = document.getElementsByClassName('tab-menu__item');
for (let i = 0; i < tabs.length; i++) {
  tabs[i].addEventListener('click', tabSwitch);
}
function tabSwitch() {
  document.getElementsByClassName('active')[0].classList.remove('active');
  this.classList.add('active');
  document.getElementsByClassName('show')[0].classList.remove('show');
  const arrayTabs = Array.prototype.slice.call(tabs);
  const index = arrayTabs.indexOf(this);
  document.getElementsByClassName('tab-content__item')[index].classList.add('show');
};
</script>
@endsection