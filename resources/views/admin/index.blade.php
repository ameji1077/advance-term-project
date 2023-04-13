@extends('layouts.default')
<style>

</style>

@section('content')
<h1>管理画面</h1>
<form action="/admin/logout" method="POST">
  @csrf
  <input type="submit" value="logout">
</form>
@endsection