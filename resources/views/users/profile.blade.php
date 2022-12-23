@extends('layouts.login')

@section('content')
UserName
<input type="text" name="name" value="{{$user->username}}">
MailAdress
<input type="text" name="email" value="{{$user->mail}}">
Passward
<input class="form-control" id="inputPassword" placeholder="パスワード" name="inputPassword" type="password" value="●●●●●●●">
new Passward
<input class="form-control" id="inputPassword" placeholder="パスワード" name="inputPassword" type="password" value="●●●●●●●">

@endsection