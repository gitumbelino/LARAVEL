@extends('layouts.main_layout')
@section('content')

<h2>Welcome {{ Auth::user()->name }}</h2>

@if(Auth::user()->user_type === 1)
    <div class="alert alert-info" role="alert">
        Admin Account
    </div>
@endif

@endsection
