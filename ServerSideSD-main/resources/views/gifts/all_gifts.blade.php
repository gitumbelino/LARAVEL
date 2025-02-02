@extends('layouts.fo_layout')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <section class="table-section">
        <h2 class="table-title">Prendas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor Previsto</th>
                    <th scope="col">Valor Gasto</th>
                    <th scope="col">Diferença</th>
                    <th scope="col">Pessoa</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gifts as $gift)
                    <tr>
                        <th scope="row">{{ $gift->id }}</th>
                        <td>{{ $gift->name }}</td>
                        <td>{{ number_format($gift->expected_value, 2) }}€</td>
                        <td>{{ number_format($gift->spent_value, 2) }}€</td>
                        <td>{{ number_format($gift->value_difference, 2) }}€</td>
                        <td>{{ $gift->username }}</td>
                        <td><a class="btn btn-info" href="{{ route('gifts.view', $gift->id) }}">Ver</a></td>
                        <td><a class="btn btn-danger" href="{{ route('gifts.delete', $gift->id) }}">Apagar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
