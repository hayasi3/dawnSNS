@extends('layouts.login')

@section('content')

<img src="/images/{{ $user->images }}" alt="ユーザアイコン">
<p>{{ $user->username }}</p>
<p>{{ $user->posts }}</p>
<p>{{ $user->created_at }}</p>

@if($followed->contains('follow',$user->id))
<form action="/post/unfollow" method="post">
@csrf
    <input type="hidden" name="id" value="{{$user->follow}}">
    <input type="submit" name="Follow2" value="フォローをはずす">
</form>

@else
<form action="/post/follow" method="post">
@csrf
    <input type="hidden" name="id" value="{{$user->id}}">
    <input type="submit" name="Follow1" value="フォローする">
</form>
@endif


@endsection