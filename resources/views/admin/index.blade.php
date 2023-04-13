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
  }

  .content{
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .form-content{
    margin: 100px auto;
    width: 500px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
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
  }

  @media screen and (max-width: 768px) {
    .header-title,
    .logout-button{
      margin-top: 20px;
    }
    .form-content{
      width: 90%;
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
  <div class="form-content">
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
@endsection