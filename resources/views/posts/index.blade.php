@extends('layouts.login')

@section('content')
<div class="message-all">
    <div class="img-box imgs">
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


@can('admin')
<p>あなたは管理者ユーザーです</p>
@else
<p>あなたは一般ユーザーです</p>
@endcan

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
    <div>
<form action="/post/detail/{{$post->id}}">
<!-- method=getは書いても書かなくても問題ないが現場に寄って変わる -->
@csrf
    <input type="submit" value="詳細を表示">
  </form>
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

<div>
    <form action="/detail/create" method="post">
    @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <select name="detail_id">
            @forelse($mylists as $mylist)
                <option value="{{$mylist->id}}">{{$mylist->name}}</option>
                @empty
                <option>リストが登録されていません</option>
            @endforelse
                <input type="submit" value="リストに登録">
        </select>
    </form>
</div>

</div>
@endforeach
@endsection