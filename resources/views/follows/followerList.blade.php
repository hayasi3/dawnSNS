@extends('layouts.login')

@section('content')
<form action="/post/follower-list" method="post">
@csrf
</form>

@endsection