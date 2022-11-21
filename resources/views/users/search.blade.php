@extends('layouts.login')

@section('content')
<form action="/post/search" method="post">
    @csrf
    <input type="text" name="search" placeholder="ユーザー名">
    <input type="image" src="/images/post.png" alt="送信">
</form>

@forelse($users as $user)
    <p>{{ $user -> username }}</p>
@empty
    <p>結果はありませんでした</p>
@endforelse

@endsection