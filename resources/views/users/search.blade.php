@extends('layouts.login')

@section('content')
<form action="/post/search" method="post">
    @csrf
    <input type="text" name="search" placeholder="ユーザー名">
    <input type="image" src="/images/post.png" alt="送信">
</form>

@foreach($users as $user)
<p>{{ $user -> users }}</p>

@endforeach

@endsection