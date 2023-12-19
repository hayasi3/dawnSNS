@extends('layouts.login')

@section('content')
 <h1>問合せ履歴</h1>
    @foreach($historys as $history)
     <p>お問合せメールアドレス:{{$history->mail}}</p>
     <p>お問合せ内容:{{$history->body}}</p>
     <p>お問合せ日時:{{$history->created_at}}</p>
     ---------------------------------------------
    @endforeach
@endsection