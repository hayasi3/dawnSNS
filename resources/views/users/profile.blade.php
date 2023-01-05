@extends('layouts.login')

@section('content')

    {{Form::open(['url' => '/post/upProfile','files' => true])}}
    @csrf
    UserName
    {{Form::text('name',$user->username, ['class' => 'form-control', 'id' => 'inputName'])}}
    <br>
    MailAdress
    {{Form::text('mail',$user->mail, ['class' => 'form-control', 'id' => 'inputName'])}}
    <br>
    Passward
    {{Form::password('inputPassword',['class' => 'form-control','id' => 'inputPassword','placeholder' => '●●●●●●●'])}}
    <br>
    new Password
    {{Form::password('password',['class' => 'form-control','id' => 'inputPassword','placeholder' => '●●●●●●●'])}}
    <br>
    Bio
    {{Form::textarea('bio',$user->bio , ['class' => 'form-control', 'id' => 'textareaRemarks', 'placeholder' => '自己紹介', 'rows' => '2'])}}
    <br>
    Icon image
    {{Form::file('image')}}
    <br>
    {{Form::submit('更新', ['class'=>'btn btn-primary btn-block'])}}
    {{Form::close()}}

@endsection