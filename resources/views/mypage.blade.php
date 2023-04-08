@extends('layouts.default')
<style>
    .user-name{
        text-align: center;
        margin: 10px 0 10px 10%;
        font-size: 28px;
    }

    .wrapper{
        display: flex;
        flex-wrap: wrap;
        margin-top: 50px;
    }

    .reservations{
        width: 50%;
    }

    .likes{
        width: 50%;
    }

    .reservation-title,
    .like-title{
        font-size: 24px;
        font-weight: bold;
    }

    .reservation-card,
    .review-card{
        margin-top: 30px;
        margin-bottom: 50px;
        padding: 30px;
        width: 80%;
        color: #fff;
        background: #315BFB;
        border-radius: 5px;
        box-shadow: 2px 2px 5px #999;
    }

    .reservation-card-head{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .reservation-head-items{
        display: flex;
        align-items: center;
        width: 120px;
        color: #fff;
    }

    .reservation-head-items img{
        width: 25%;
    }

    .reservation-number{
        margin-left: 30px;
        font-size: 20px;
    }

    .reservation-delete-button{
        color: #fff;
        background: #315BFB;
        font-size: 20px;
        border: 2px solid #fff;
        border-radius: 50%;
        cursor: pointer;
    }

    .reservation-update-form{
        position: relative;
    }

    .reservation-card table{
    color: #fff;
    }

    .reservation-card tr{
    font-size: 16px;
    line-height: 3;
    font-weight: bold;
    }

    .reservation-card th{
    width: 80px;
    text-align: left;
    }

    .reservation-card tr:first-of-type th{
    padding-top: 20px;
    }

    .reservation-card td{
    text-align: left;
    }

    .input-date,
    .input-time,
    .input-number{
        width: 100%;
        height: 30px;
        border: none;
        border-radius: 5px;
    }

    .update-btn{
        position: absolute;
        bottom: 5px;
        right: 0;
        height: 30px;
        background: #fff;
        border: none;
        border-radius: 5px;
    }

    .shop-card-wrapper{
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 20px;
        margin-top: 10px;
        margin-bottom: 50px;
    }

    .shop-card{
        margin-top: 20px;
        width: 290px;
        height: 300px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 2px 2px 2px #999;
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

    .review-title{
        font-size: 20px;
    }

    .label-review{
        display: block;
        margin-top: 10px;
    }

    .select-review{
        width: 30%;
        height: 30px;
        border: none;
        border-radius: 5px;
    }

    .rate-form {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .rate-form input[type=radio] {
        display: none;
    }

    .rate-form label {
        position: relative;
        padding: 0 5px;
        color: #ccc;
        cursor: pointer;
        font-size: 20px;
    }

    .rate-form label:hover {
        color: #ffff00;
    }

    .rate-form label:hover ~ label {
        color: #ffff00;
    }

    .rate-form input[type=radio]:checked ~ label {
        color: #ffff00;
    }

    .error-message{
        color: #ff0000;
    }

    .textarea-comment{
        display: block;
        width: 80%;
        height: 100px;
        margin-top: 10px;
    }

    .review-button{
        margin-top: 10px;
        padding: 5px 10px;
        background: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<header class="header">
    @include('components.header-items-1')
</header>

@section('content')
    <h2 class="user-name">{{$user->name}}さん</h2>
    <div class="wrapper">
        <div class="reservations">
            <h3 class="reservation-title">予約状況</h3>
            @foreach ($reservations as $i => $reservation)
            @if (strtotime(date('Y-m-d H:i')) < strtotime($reservation->start_at))
                <div class="reservation-card">
                    <div class="reservation-card-head">
                        <div class="reservation-head-items">
                            <img src="{{asset('images/time-icon.png')}}" alt="時計">
                            <h4 class="reservation-number">予約{{$i + 1}}</h4>
                        </div>
                        <form action="/reserve/delete" method="POST">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{$reservation->id}}">
                            <button class="reservation-delete-button">×</button>
                        </form>
                    </div>
                    <form action="/reserve/update" method="post" class="reservation-update-form">
                        @csrf
                        <input type="hidden" name="id" value="{{$reservation->id}}">
                        <table>
                            <tr>
                                <th>Shop</th>
                                <td>{{$reservation->shop->name}}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>
                                    <input type="date" name="date" class="input-date" value="{{$reservation->start_at->format('Y-m-d')}}" onkeydown="return false">
                                </td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td>
                                    <select name="time" class="input-time">
                                        <option value="{{$reservation->start_at->format('H:i')}}">{{$reservation->start_at->format('H:i')}}</option>
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
                                </td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td>
                                    <select name="num_of_users" class="input-number" style="width: 100%;">
                                        <option value="{{$reservation->num_of_users}}">{{$reservation->num_of_users}}人</option>
                                        @for ($i = 1; $i <= 20; $i++)
                                        echo '<option value={{$i}}>{{$i}}人</option>'
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <button class="update-btn">予約を更新する</button>
                    </form>
                </div>
                @endif
                @endforeach
        </div>
        <div class="likes">
            <h3 class="like-title">お気に入り店舗</h3>
            @if ($likes)
            <div class="shop-card-wrapper">
                @foreach ($likes as $like)
                <div class="shop-card">
                    <div class="shop-img">
                        <img src="{{$like->shop->image_url}}" alt="ショップイメージ">
                    </div>
                    <div class="shop-detail">
                        <h2 class="shop-name">{{$like->shop->name}}</h2>
                        <p class="shop-info">#{{$like->shop->area->name}} #{{$like->shop->genre->name}}</p>
                        <div class="shop-form">
                            <form action="/detail/{{$like->shop->id}}" method="GET" class="shop-detail-btn">
                                <button>詳しくみる</button>
                            </form>
                            <form action="/favorite/delete" method="POST">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{$like->shop->id}}">
                                <button class="like">
                                    <img src="{{asset('images/like.png')}}" alt="like">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <p class="no-like-shop">現在、お気に入りに登録している店舗がありません</p>
            @endif
        </div>
    </div>
    <div class="review-card">
        <h4 class="review-title">レビューを投稿する</h4>
        <form action="/review" method="POST">
            @csrf
            <label class="label-review">予約店舗情報：
                <select name="reservation_id" id="selectShopId" class="select-review">
                    @foreach ($reservations as $reservation)
                        @if (strtotime(date('Y-m-d H:i')) >= strtotime($reservation->start_at))
                            @php
                                $review = \App\Models\Review::where('reservation_id', $reservation->id)->first();
                            @endphp
                            @if ($review == null)
                                <option value="{{$reservation->id}}">{{$reservation->shop->name}}〜{{$reservation->start_at}}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </label>
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input type="hidden" name="shop_id" id="hiddenShopId" value="{{$reservation->shop->id}}">
            <div class="rate-form">
                <input id="star5" type="radio" name="stars" value="5">
                <label for="star5">★</label>
                <input id="star4" type="radio" name="stars" value="4">
                <label for="star4">★</label>
                <input id="star3" type="radio" name="stars" value="3">
                <label for="star3">★</label>
                <input id="star2" type="radio" name="stars" value="2">
                <label for="star2">★</label>
                <input id="star1" type="radio" name="stars" value="1">
                <label for="star1">★</label>
            </div>
            @error('stars')
                <p class="error-message">{{$message}}</p>
            @enderror
            <textarea name="comment" class="textarea-comment" placeholder="コメントをお願いします"></textarea>
            <button class="review-button">レビューを送信する</button>
        </form>
    </div>
    <script src="{{asset('/js/main.js')}}"></script>
@endsection