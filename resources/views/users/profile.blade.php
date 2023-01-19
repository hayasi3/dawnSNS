@extends('layouts.login')

@section('content')
<div class="prof-box">
    <div class="img-box prof-img">
        <img src="{{ asset('storage/images/'.$user->images) }}">
    </div>
    <div class="prof-text">
        {{Form::open(['url' => '/post/upProfile','files' => true])}}
        @csrf
        <div class="prof name">
            UserName
            {{Form::text('name',$user->username, ['class' => 'form-control', 'id' => 'inputName'])}}
            <br>
        </div>
        <div class="prof mail">
            MailAdress
            {{Form::text('mail',$user->mail, ['class' => 'form-control', 'id' => 'inputName'])}}
            <br>
        </div>
        <div class="prof pass">
            Passward
            {{Form::password('inputPassword',['class' => 'form-control','id' => 'inputPassword','placeholder' => '●●●●●●●'])}}
            <br>
        </div>
        <div class="prof newpass">
            new Password
            {{Form::password('password',['class' => 'form-control','id' => 'inputPassword','placeholder' => '●●●●●●●'])}}
        <br>
        </div>
        <div class="prof bio">
            Bio
            {{Form::textarea('bio',$user->bio , ['class' => 'form-control', 'id' => 'textareaRemarks', 'placeholder' => '自己紹介', 'rows' => '2'])}}
            <br>
        </div>
        <div class="prof img">
            Icon image
            {{Form::file('image')}}
            <br>
        </div>
        <div class="prof update">
            {{Form::submit('更新', ['class'=>'btn btn-primary btn-block'])}}
            {{Form::close()}}
        </div>
    </div>
</div>

@endsection