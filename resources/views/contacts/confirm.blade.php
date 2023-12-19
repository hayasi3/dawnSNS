@extends('layouts.login')

@section('content')
    <h1>確認画面</h1>
    <h2>以下の内容でお間違いないでしょうか？</h2>
     <div>
        <h3>メールアドレス:{{$email}}</h3>
        <h3>お問合せ内容:{{$body}}</h3>
        <form action="{{route('send')}}" method="post">
            @csrf
                <input type="hidden"name="id" value="{{$id}}">
                <input type="hidden" name="email" value="{{$email}}">
                <input type="hidden" name="body" value="{{$body}}">
                <input type="submit" value="送信">
        </form>
     </div>
@endsection