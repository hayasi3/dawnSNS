@extends('layouts.login')

@section('content')
<form action="/post/create" method="post">
    @csrf
    <input type="text" name="newpost" placeholder="なにをつぶやこうか・・・">
    <input type="submit" value="投稿する">
</form>

@foreach($posts as $post)
<p>{{ $post->posts}} {{ $post->username}}</p>
<a class="btn btn-danger" href="/post/{{ $post->id }}/delete" onclick="return confirm('こちらのつぶやきをを削除してもよろしいでしょうか？')">削除</a>
@endforeach

@endsection