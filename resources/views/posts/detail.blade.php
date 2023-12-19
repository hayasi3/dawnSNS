@extends('layouts.login')

@section('content')
<div class="post-all">
    <div class="user-img">
        <div class="img-box">
            <img src="{{ asset('storage/images/'.$post->images) }}" alt="ユーザアイコン">
        </div>
    </div>
    <div class="post-box">
        <div class="user-status">
            <span>{{ $post->username }}</span>
            <span>{{ $post->created_at }}</span>
        </div>
        <div class="text">
            {{ $post->posts }}
        </div>
        <div class="btn-box">
            @if($post->user_id == Auth::id())
                <div class="up-btn">
                    <div class="modalopen" data-target="{{$post->id}}">
                        <img src="/images/edit.png" alt="更新">
                    </div>
                    <div class="modal-main" id="{{$post->id}}">
                        <div class="modal-inner">
                            <div class="modal-white">
                                <form action="/post/update" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                    <input type="text" name="editpost" value="{{ $post->posts }}">
                                    <input type="image" src="/images/edit.png" alt="更新">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="delet-btn">
                    <form action="/post/delete" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <input type="image" src="/images/trash.png" alt="削除" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                    </form>
                </div>
            @endif
        </div>
    </div>
<div>
@if($favorite_exsits->contains('favorite_id',$post->id))
<form action="/favorite/delete" method="post">
@csrf
    <input type="hidden" name="id" value="{{$post->id}}">
    <input type="submit" value="いいねをはずす">
  </form>
@else
<form action="/favorite/create" method="post">
@csrf
    <input type="hidden" name="id" value="{{$post->id}}">
    <input type="submit" value="いいね">
  </form>
@endif
</div>
</div>

<div>
<div class="img-box imgs">
        <img src="{{ asset('storage/images/'.$user->images) }}">
    </div>
    <div class="message-box">
        <form action="/comment/create" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$post->id}}">
            <input type="text" id="messeage" name="newcomment" placeholder="返信内容">
            <input type="submit" value="返信">
        </form>
</div>
</div>

@forelse($comments as $comment)
<div class="post-all">
    <div class="user-img">
        <div class="img-box">
            <img src="{{ asset('storage/images/'.$comment->images) }}" alt="ユーザアイコン">
        </div>
    </div>
    <div class="post-box">
        <div class="user-status">
            <span>{{ $comment->username }}</span>
            <span>{{ $comment->created_at }}</span>
        </div>
        <div class="text">
            {{ $comment->body }}
        </div>
    </div>
    @if($comment->user_id == Auth::id())
    <div class="delet-btn">
    <form action="/comment/update" method="post">
                        @csrf
                        @method('put'){{--ルーティングをゲット、ポストの他にわかりやすくするために記載する（※この記載がある場合ルーティングのゲット、ポストのところにputと記載する）--}}
                        <input type="hidden" name="id" value="{{$comment->id}}">
                        <input type="text" name="upComment" value="{{$comment->body}}">
                        <input type="image" src="/images/edit.png">
    </form>
                    <form action="/comment/delete" method="post">
                        @csrf
                        @method('delete'){{--ルーティングをゲット、ポストの他にわかりやすくするために記載する（※この記載がある場合ルーティングのゲット、ポストのところにdeleteと記載する）--}}
                        <input type="hidden" name="id" value="{{$comment->id}}">
                        <input type="image" src="/images/trash.png" alt="削除" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                    </form>
                </div>
    @endif
</div>
@empty{{--forelseの条件分岐の時だけemptyをつかう--}}
<p>まだ返信がありません</p>
@endforelse

@endsection