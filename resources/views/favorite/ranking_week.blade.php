@extends('layouts.login')

@section('content')

<h1>ランキングページ</h1>
<div>
@foreach($ranking_posts as $ranking_post)
    <img src="{{ asset('storage/images/'.$ranking_post->images) }}">
    <p>{{ $ranking_post -> username }}</p>
    <p>{{ $ranking_post -> posts }}</p>
    <p>{{ $ranking_post -> created_at}}</p>

@if($favorite_exsits->contains('favorite_id',$ranking_post->id))
<form action="/favorite/delete" method="post">
@csrf
    <input type="hidden" name="id" value="{{$ranking_post->id}}">
    <input type="submit" value="いいねをはずす">
  </form>
@else
<form action="/favorite/create" method="post">
@csrf
    <input type="hidden" name="id" value="{{$ranking_post->id}}">
    <input type="submit" value="いいね">
  </form>
@endif
<div>
</div>

@endforeach
</div>


@endsection