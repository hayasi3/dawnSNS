@extends('layouts.login')

@section('content')

<img src="/images/{{ $other_user->images }}" alt="ユーザアイコン">
<p>{{ $other_user->username }}</p>
<p>{{ $other_user->posts }}</p>
<p>{{ $other_user->created_at }}</p>

@if($followed->contains('follow',$other_user->id))
<form action="/post/unfollow" method="post">
@csrf
    <input type="hidden" name="id" value="{{$other_user->follow}}">
    <input type="submit" name="Follow2" value="フォローをはずす">
</form>

@else
<form action="/post/follow" method="post">
@csrf
    <input type="hidden" name="id" value="{{$other_user->id}}">
    <input type="submit" name="Follow1" value="フォローする">
</form>
@endif


@endsection