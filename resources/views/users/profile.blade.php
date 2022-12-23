@extends('layouts.login')

@section('content')
UserName
{{Form::text('inputName',$user->username, ['class' => 'form-control', 'id' => 'inputName'])}}
<br>
MailAdress
{{Form::text('inputName',$user->mail, ['class' => 'form-control', 'id' => 'inputName'])}}
<br>
Passward
{{Form::password('inputPassword',['class' => 'form-control','id' => 'inputPassword','placeholder' => '●●●●●●●'])}}
<br>
new Passward
{{Form::password('inputPassword',['class' => 'form-control','id' => 'inputPassword','placeholder' => '●●●●●●●'])}}
<br>
Bio
{{Form::textarea('textareaRemarks', null, ['class' => 'form-control', 'id' => 'textareaRemarks', 'placeholder' => '自己紹介', 'rows' => '2'])}}
<br>
Icon image
{{Form::file('image', ['class'=>'custom-file-input','id'=>'fileImage'])}}
<br>
<input type="submit" name="update" value="更新">

@endsection