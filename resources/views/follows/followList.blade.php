@extends('layouts.login')

@section('content')
<form action="/post/follow-list" method="post">
@csrf
</form>

@foreach($users as $user)
<a href="/other-prof/{{ $user->id }}"><img src="/images/{{ $user->images }}" alt="ユーザアイコン"></a>
@endforeach
<br>
@foreach($users as $user)
<img src="/images/{{ $user->images }}" alt="ユーザアイコン">
<p>{{ $user->username }}</p>
<p>{{ $user->posts }}</p>
<p>{{ $user->created_at }}</p>
@endforeach

@endsection