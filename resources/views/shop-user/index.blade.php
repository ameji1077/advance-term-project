@extends('layouts.default')
<style>

</style>

@section('content')
<h1>管理画面ショップの方だよ？</h1>
<form action="/shop-user/logout" method="POST">
  @csrf
  <input type="submit" value="logout">
</form>
@endsection