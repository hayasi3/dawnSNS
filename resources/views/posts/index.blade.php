@extends('layouts.login')

@section('content')
<div class="message-all">
    <div class="img-box">
        <img src="{{ asset('storage/images/'.$user->images) }}">
    </div>
    <div class="message-box">
        <form action="/post/create" method="post">
            @csrf
            <!-- <div class="message-box"> -->
                <input type="text" id="messeage" name="newpost" placeholder="なにをつぶやこうか・・・?">
                <input type="image" id="send" src="/images/post.png" alt="送信">
            <!-- </div> -->
        </form>
    </div>
</div>

@foreach($posts as $post)
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
</div>
@endforeach
@endsection