@extends('layouts.login')

@section('content')
<form action="/post/search" method="post">
    @csrf
    <input type="text" name="search" placeholder="ユーザー名">
    <input type="image" src="/images/post.png" alt="送信">
</form>

@forelse($users as $user)
    <p>{{ $user -> username }}</p>
@empty
    <p>結果はありませんでした</p>
    <img src="/images/edit.png" alt="更新">
@endforelse

@foreach($users as $user)
<form method="post">
    @csrf
    <input type="submit" name="Follow1" value="フォローする">
  </form>

  <form method="post">
    @csrf
    <input type="submit" name="Follow2" value="フォローをはずす">
  </form>
@endforeach

@endsection