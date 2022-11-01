@extends('layouts.login')

@section('content')
<form action="/post/create" method="post">
    @csrf
    <input type="text" name="newpost" placeholder="なにをつぶやこうか・・・">
    <input type="submit" value="投稿する">
</form>
@endsection