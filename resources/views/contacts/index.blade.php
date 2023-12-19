@extends('layouts.login')

@section('content')
<div class="message-box">
    <h1>お問い合わせフォーム</h1>
        <form action="{{route('confirm')}}" method="post">
            @csrf
                <input type="hidden"name="id" value="{{$user->id}}">
                <input type="email" name="email" value="{{$user->mail}}">
                <textarea name="body"></textarea>
                <input type="submit" value="確認画面へ">
        </form>
</div>
@endsection