@extends('layouts.main_layout')
@section('content')

<!--mensagem de confirmação, quando se apaga um user-->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif
<section class="table-section">
    <div>
        <h2 class="table-title">Utilizadores</h2>
        <form>
            <input type="text" id="" name="search" value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-secondary">Procurar</button>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allUsers as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a class="btn btn-info" href="{{ route('users.view', $user->id) }}">Ver</a></td>
                    <td><a class="btn btn-danger" href="{{ route('users.delete', $user->id) }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
