@extends('layouts.login')

@section('content')


@foreach($users as $otheruser)
<a href="/other-prof/{{ $otheruser->id }}"><img src="storage/images/{{ $otheruser->images }}" alt="ユーザアイコン"></a>
@endforeach
<br>
@foreach($users as $otheruser)
<a href="/other-prof/{{ $otheruser->id }}"><img src="storage/images/{{ $otheruser->images }}" alt="ユーザアイコン"></a>
<p>{{ $otheruser->username }}</p>
<p>{{ $otheruser->posts }}</p>
<p>{{ $otheruser->created_at }}</p>
@endforeach

@endsection