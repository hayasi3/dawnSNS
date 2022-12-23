@extends('layouts.login')

@section('content')
<form action="/post/follower-list" method="post">
@csrf
</form>

@foreach($users as $otheruser)
<a href="/other-prof/{{ $otheruser->id }}"><img src="/images/{{ $user->images }}" alt="ユーザアイコン"></a>
@endforeach
<br>
@foreach($users as $otheruser)
<a href="/other-prof/{{ $otheruser->id }}"><img src="/images/{{ $otheruser->images }}" alt="ユーザアイコン"></a>
<p>{{ $otheruser->username }}</p>
<p>{{ $otheruser->posts }}</p>
<p>{{ $otheruser->created_at }}</p>
@endforeach

@endsection