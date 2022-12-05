@extends('layouts.login')

@section('content')
<form action="/post/search" method="post">
    @csrf
    <input type="text" name="search" placeholder="ユーザー名">
    <input type="image" src="/images/post.png" alt="送信">
</form>

<!-- $userにすると重複し、layouts.loginの名前が置き換わるため$personalに変更 -->
@forelse($users as $personal)
    <p>{{ $personal -> username }}</p>

    <form action="/post/follow" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$personal->id}}">
    <input type="submit" name="Follow1" value="フォローする">
  </form>

  <form action="/post/unfollow" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$personal->id}}">
    <input type="submit" name="Follow2" value="フォローをはずす">
  </form>

@empty
    <p>結果はありませんでした</p>
@endforelse

@endsection