@extends('layouts.login')

@section('content')

<img src="/images/{{ $user->images }}" alt="ユーザアイコン">
<p>{{ $user->username }}</p>
<p>{{ $user->posts }}</p>
<p>{{ $user->created_at }}</p>

@endsection