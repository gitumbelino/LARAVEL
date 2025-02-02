@extends('layouts.fo_layout')
@section('content')

<section class="table-section">
    <h2 class="table-title">Utilizadores</h2>
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
                    <td><a class="btn btn-danger" href="{{ route('users.delete', $user->id) }}">Apagar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection
