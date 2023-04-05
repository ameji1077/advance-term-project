<form action="{{$route}}" method="POST">
  @csrf
  <input type="hidden" name="shop_id" value="{{$shop->id}}">
  <button class="like">
    <img src="{{asset('images/like.png')}}" alt="like">
  </button>
</form>

<style>
  .like{
    width: 50px;
    border: none;
    background: #fff;
    margin-bottom: 10px;
    cursor: pointer;
  }

  img{
    width: 100%;
  }
</style>