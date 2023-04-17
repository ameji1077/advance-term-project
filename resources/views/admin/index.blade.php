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

  .content{
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .tab {
  width: 600px;
  margin: 100px auto;
  }

  .tab-menu {
    display: flex;
  }

  .tab-menu__item {
    text-align: center;
    padding: 10px 0;
    cursor: pointer;
    list-style: none;
    background: #fff;
    width: 100px;
    border-top: 1px solid #315BFB;
    border-left: 1px solid #315BFB;
    border-right: 1px solid #315BFB;
  }

  .tab-menu__item:first-child {
    margin-left: 10px;
  }

  .tab-menu__item:not(:first-child) {
    border-left: none;
  }

  .tab-menu__item.active {
    background: #315BFB;
    color: #fff;
  }

  .tab-content__item {
    display: none;
    width: 600px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .tab-content__item.show {
    display: block;
  }

  .form-header{
    padding: 20px;
    background: #315BFB;
    border-radius: 5px 5px 0 0;
  }

  .form-title{
    color: #fff;
    font-size: 20px;
  }

  .shop-user-create-form{
    margin: 20px;
    padding-bottom: 10px;
  }

  .shop-user-create-form table{
    width: 100%;
    text-align: left;
  }
  
  .shop-user-create-form tr{
    height: 45px;
    vertical-align: middle;
  }
  
  .shop-user-create-form th{
    width: 40%;
    vertical-align: middle;
  }

  .shop-user-create-form td{
    width: 60%;
    vertical-align: middle;
  }

  .shop-user-create-form input,
  .shop-user-create-form select{
    width: 100%;
    height: 30px;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .shop-user-create-form .error-message{
    color: #ff0000;
    vertical-align: bottom;
  }

  .form-button{
    display: block;
    margin-top: 10px;
    margin-left: auto;
    padding: 5px 10px;
    color: #fff;
    background: #315BFB;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
    cursor: pointer;
  }

  .shop-users-table{
    margin: 20px;
    padding-bottom: 10px;
  }

  .shop-users-table table{
    text-align: left;
    width: 100%;
  }

  .shop-users-table th:nth-of-type(1),
  .shop-users-table td:nth-of-type(1){
    width: 25%;
    padding-right: 10px;
  }

  .shop-users-table th:nth-of-type(2),
  .shop-users-table td:nth-of-type(2){
    width: 45%;
  }

  .shop-users-table th:nth-of-type(3),
  .shop-users-table td:nth-of-type(3){
    width: 30%;
    padding-left: 10px;
  }

  @media screen and (max-width: 768px) {
    .header-title,
    .logout-button{
      margin-top: 20px;
    }

    .tab{
      width: 100%;
    }

    .tab-content__item{
      width: 100%;
    }

    .shop-users-table th:nth-of-type(1),
    .shop-users-table td:nth-of-type(1){
      width: 30%;
    }

    .shop-users-table th:nth-of-type(2),
    .shop-users-table td:nth-of-type(2) div{
      white-space: nowrap;
      overflow: scroll;
      width: 100px;
    }

    .shop-users-table th:nth-of-type(3),
    .shop-users-table td:nth-of-type(3){
      width: 50px;
    }
  }
</style>

<header class="header">
  <h1 class="header-title">管理画面</h1>
  <form action="/admin/logout" method="POST">
    @csrf
    <input type="submit" value="logout" class="logout-button">
  </form>
</header>

@section('content')
<div class="tab">
  <ul class="tab-menu">
    <li class="tab-menu__item active">作成</li>
    <li class="tab-menu__item">一覧</li>
  </ul>
  <div class="tab-content__item show">
    <div class="form-header">
      <h2 class="form-title">
        店舗代表者を作成する
      </h2>
    </div>
    <form action="/admin/shop-user/create" method="POST" class="shop-user-create-form">
      @csrf
      <table>
        @error('name')
          <tr >
            <th></th>
            <td class="error-message">{{$message}}</td>
          </tr>
        @enderror
        <tr>
          <th>店舗代表者名</th>
          <td>
            <input type="text" name="name" placeholder="name">
          </td>
        </tr>
        @error('email')
          <tr>
            <th></th>
            <td class="error-message">{{$message}}</td>
          </tr>
        @enderror
        <tr>
          <th>メールアドレス</th>
          <td>
            <input type="email" name="email" placeholder="email">
          </td>
        </tr>
        @error('password')
          <tr>
            <th></th>
            <td class="error-message">{{$message}}</td>
          </tr>
        @enderror
        <tr>
          <th>パスワード</th>
          <td>
            <input type="password" name="password" placeholder="password">
          </td>
        </tr>
        @error('shop_level')
          <tr>
            <th></th>
            <td class="error-message">{{$message}}</td>
          </tr>
        @enderror
        <tr>
          <th>店舗レベル</th>
          <td>
            <select name="shop_level">
              @for ($i = 0; $i <= 10; $i++)
                <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </td>
        </tr>
      </table>
      <button class="form-button">作成する</button>
    </form>
  </div>
  <div class="tab-content__item">
    <div class="form-header">
      <h2 class="form-title">
        店舗代表者一覧
      </h2>
    </div>
    <div class="shop-users-table">
      <table>
        <tr>
          <th>店舗代表者名</th>
          <th>メールアドレス</th>
          <th>店舗レベル</th>
        </tr>
        @foreach ($shop_users as $shop_user)
          <tr>
            <td>{{$shop_user->name}}</td>
            <td>
              <div>
                {{$shop_user->email}}
              </div>
            </td>
            <td>{{$shop_user->shop_level}}</td>
          </tr>
        @endforeach
      </table>
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
