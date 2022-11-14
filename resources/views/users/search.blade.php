@extends('layouts.login')

@section('content')
<form action="/post/search" method="post">
    @csrf
    <input type="text" name="search" placeholder="ユーザ名">
    <input type="image" src="/images/post.png" alt="送信">
</form>


@endsection