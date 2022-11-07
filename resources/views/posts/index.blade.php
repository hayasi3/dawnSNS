@extends('layouts.login')

@section('content')
<form action="/post/create" method="post">
    @csrf
    <input type="text" name="newpost" placeholder="なにをつぶやこうか・・・">
    <input type="submit" value="投稿する">
</form>

@foreach($posts as $post)
<p>{{ $post->posts}} {{ $post->username}}</p>

<form action="/post/delete" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$post->id}}">
    <input type="submit" value="削除">
</form>

@endforeach

@endsection