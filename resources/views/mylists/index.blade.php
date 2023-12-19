@extends('layouts.login')

@section('content')

<div class="message-box">
        <form action="/mylist/create" method="post">
            @csrf
            <input type="text" id="messeage" name="newMylist" placeholder="カテゴリ名前を入力">
            <input type="image" id="send" src="/images/post.png" alt="作成">
        </form>
</div>

<h2>マイリスト一覧</h2>
<div>
    @forelse($mylists as $mylist)
    <p><a href="/mylist/detail/{{$mylist->id}}">{{$mylist->name}}</a></p>
    <div>
        <form action="/mylist/update" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{ $mylist->id }}">
            <input type="text" name="editMylist" value="{{ $mylist->name }}">
            <input type="image" src="/images/edit.png" alt="更新">
        </form>
    </div>
    <div class="delet-btn">
        <form action="/mylist/delete" method="post">
         @csrf
         @method('delete')
         <input type="hidden" name="id" value="{{$mylist->id}}">
         <input type="image" src="/images/trash.png" alt="削除" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
        </form>
    </div>
    @empty
    <p>マイリスト未作成です</p>
    @endforelse
</div>

@endsection