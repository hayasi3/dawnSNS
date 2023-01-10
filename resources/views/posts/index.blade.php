@extends('layouts.login')

@section('content')
<form action="/post/create" method="post">
    @csrf
    <input type="text" name="newpost" placeholder="なにをつぶやこうか・・・">
    <input type="image" src="/images/post.png" alt="送信">
</form>

@foreach($posts as $post)
<img src="{{ asset('storage/images/'.$post->images) }}" alt="ユーザアイコン">
<p>{{ $post->posts }}</p>
<p>{{ $post->username }}</p>
<p>{{ $post->created_at }}</p>

<img src="/images/edit.png" alt="更新">
<form action="/post/update" method="post">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $post->id }}">
    <input type="text" name="editpost" value="{{ $post->posts }}">
    <input type="image" src="/images/edit.png" alt="更新">
</form>

<form action="/post/delete" method="post">
    @csrf
    @method('delete')
    <input type="hidden" name="id" value="{{$post->id}}">
    <input type="image" src="/images/trash.png" alt="削除" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
</form>

@endforeach

@endsection