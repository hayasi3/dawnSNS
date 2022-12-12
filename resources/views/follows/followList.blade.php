@extends('layouts.login')

@section('content')
<form action="/post/follow-list" method="post">
@csrf
</form>

@foreach