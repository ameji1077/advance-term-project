@extends('layouts.default')
<style>
  .header{
    display: flex;
    justify-content: space-between;
  }

  .search-form{
    padding: 0 5px;
    width: 600px;
    line-height: 3;
    background: #fff;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
  }

  .select{
    padding: 0 10px;
    border: none;
    border-right: 1px solid #ddd;
  }

  .search-box{
    display: inline-block;
  }

  .submit-button{
    width: 30px;
    vertical-align: middle;
    background: #fff;
    border: none;
    opacity: 0.5;
  }

  .submit-button img{
    width: 100%;
  }

  .search-input{
    width: 80%;
    border: none;
  }

  .shop-card-wrapper{
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 10px;
    margin-bottom: 50px;
  }

  .shop-card{
    margin-top: 20px;
    width: 280px;
    height: 300px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 2px 2px 5px #999;
  }

  .shop-img img{
    width: 100%;
    height: 50%;
    border-radius: 10px 10px 0 0;
  }

  .shop-detail{
    margin: 0 20px;
  }

  .shop-name{
    margin-top: 20px;
    font-size: 20px;
  }

  .shop-info{
    margin-top: 20px;
    font-size: 12px;
  }

  .shop-form{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
  }

  .shop-detail-btn button{
    background: #0000ff;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .like{
    width: 50px;
    border: none;
    background: #fff;
    margin-bottom: 10px;
    cursor: pointer;
  }

  .like img{
    width: 100%;
  }

  .redirect-login{
    width: 40px;
    border: none;
    background: #fff;
    margin-bottom: 10px;
    cursor: pointer;
  }

  .redirect-login img{
    width: 100%;
  }

  @media screen and (max-width: 768px) {
    .header{
      display: block;
    }

    .search-form{
      margin-top: 10px;
      width: 100%;
    }

    .shop-card{
      margin: 10px auto;
      width: 90%;
      height: 90%;
    }

    .shop-name,
    .shop-info,
    .shop-form{
      margin-top: 5%;
    }
  }
</style>

<header class="header">
  @isset($user)
  @include('components.header-items-1')
  @else
  @include('components.header-items-2')
  @endisset
  <form action="/find" method="GET" class="search-form">
    @csrf
    <select name="area_id" class="select">
      <option selected value>All area</option>
      @foreach($areas as $area)
      <option value="{{ $area->id }}">{{ $area->name }}</option>
      @endforeach
    </select>
    <select name="genre_id" class="select">
      <option selected value>All genre</option>
      @foreach($genres as $genre)
      <option value="{{ $genre->id }}">{{ $genre->name }}</option>
      @endforeach
    </select>
    <div class="search-box">
      <button type="submit" class="submit-button">
        <img src="{{asset('images/search-icon.png')}}" alt="検索">
      </button>
      <input type="text" name="name" class="search-input" placeholder="Search...">
    </div>
  </form>
</header>

@section('content')
<div class="shop-card-wrapper">
  @foreach ($shops as $shop)
  <div class="shop-card">
    <div class="shop-img">
      <img src="{{$shop->image_url}}" alt="ショップイメージ">
    </div>
    <div class="shop-detail">
      <h2 class="shop-name">{{$shop->name}}</h2>
      <p class="shop-info">#{{$shop->area->name}} #{{$shop->genre->name}}</p>
      <div class="shop-form">
        <form action="/detail/{{$shop->id}}" method="GET" class="shop-detail-btn">
          <button>詳しくみる</button>
        </form>
        @if (Auth::check())
          @php
            $like = \App\Models\Like::where('user_id', Auth::id())->where('shop_id', $shop->id)->first();
          @endphp
          @if ($like)
            <form action="/favorite/delete" method="POST">
              @csrf
              <input type="hidden" name="shop_id" value="{{$shop->id}}">
              <button class="like">
                <img src="{{asset('images/like.png')}}" alt="like">
              </button>
            </form>
          @else
            <form action="/favorite" method="POST">
              @csrf
              <input type="hidden" name="shop_id" value="{{$shop->id}}">
              <button class="like">
                <img src="{{asset('images/not-like.png')}}" alt="not-like">
              </button>
            </form>
          @endif
        @else
            <a href="/login" class="redirect-login">
              <img src="{{asset('images/not-like.png')}}" alt="not-like">
            </a>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection