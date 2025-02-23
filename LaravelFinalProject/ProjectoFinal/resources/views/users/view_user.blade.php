@extends('layouts.main_layout')
@section('content')
<h5>User info:</h5>
    <h6>Name: {{ $user->name }}</h6>
    <h6>Email: {{ $user->email }}</h6>
@endsection
