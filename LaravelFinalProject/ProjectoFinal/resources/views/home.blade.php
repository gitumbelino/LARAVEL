@extends('layouts.main_layout')
@section('content')
@auth
<h2>olá {{ Auth::user()->name }}</h2>
@endauth
<section class="main-message">
    <h2>Welcome, feel free to browse <br>through my favorite musicians</h2>
</section>
@endsection



