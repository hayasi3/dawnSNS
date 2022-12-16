@extends('layouts.login')

@section('content')

<img src="/images/{{ $user->images }}" alt="ユーザアイコン">
<p>{{ $user->username }}</p>
<p>{{ $user->posts }}</p>
<p>{{ $user->created_at }}</p>

@if($id->contains('follows.follow'))
<form action="/other-prof/{id}" method="post">
@csrf
    <input type="hidden" name="id" value="{{$id}">
    <input type="submit" name="Follow2" value="フォローをはずす">
</form>

@else
<form action="/other-prof/{id}" method="post">
@csrf
    <input type="hidden" name="id" value="{{$id}}">
    <input type="submit" name="Follow1" value="フォローする">
</form>
@endif


@endsection