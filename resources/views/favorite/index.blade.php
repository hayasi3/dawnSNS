@extends('layouts.login')

@section('content')
<h1>いいね一覧画面</h1>
<div>
@forelse($favorite_posts as $favorite_post)
    <img src="{{ asset('storage/images/'.$favorite_post->images) }}">
    <p>{{ $favorite_post -> username }}</p>
    <p>{{ $favorite_post -> posts }}</p>
    <p>{{ $favorite_post -> created_at}}</p>

@if($favorite_exsits->contains('favorite_id',$favorite_post->id))
<form action="/favorite/delete" method="post">
@csrf
    <input type="hidden" name="id" value="{{$favorite_post->id}}">
    <input type="submit" value="いいねをはずす">
  </form>
@else
<form action="/favorite/create" method="post">
@csrf
    <input type="hidden" name="id" value="{{$favorite_post->id}}">
    <input type="submit" value="いいね">
  </form>
@endif

@empty
    <p>まだいいねしている投稿はありません</p>
@endforelse
</div>

@endsection