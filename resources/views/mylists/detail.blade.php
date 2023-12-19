@extends('layouts.login')

@section('content')

<h1>マイリスト:{{$detail->name}}</h1>
<div>
@forelse($detail_posts as $detail_post)
    <img src="{{ asset('storage/images/'.$detail_post->images) }}">
    <p>{{ $detail_post -> username }}</p>
    <p>{{ $detail_post -> posts }}</p>
    <p>{{ $detail_post -> created_at}}</p>

@if($favorite_exsits->contains('favorite_id',$detail_post->id))
<form action="/favorite/delete" method="post">
@csrf
    <input type="hidden" name="id" value="{{$detail_post->id}}">
    <input type="submit" value="いいねをはずす">
  </form>
@else
<form action="/favorite/create" method="post">
@csrf
    <input type="hidden" name="id" value="{{$detail_post->id}}">
    <input type="submit" value="いいね">
  </form>
@endif
<div>
<form action="/detail/delete" method="post">
@csrf
    <input type="hidden" name="post_id" value="{{$detail_post->id}}">
    <input type="hidden" name="detail_id" value="{{$detail->id}}">
    <input type="submit" value="この投稿を{{$detail->name}}からはずす">
  </form>
</div>

@empty
    <p>まだ{{$detail->name}}に登録されている投稿はありません</p>
@endforelse
</div>

@endsection