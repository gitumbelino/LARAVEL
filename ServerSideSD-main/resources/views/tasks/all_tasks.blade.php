@extends('layouts.fo_layout')
@section('content')

    <section class="table-section">
        <h2 class="table-title">Tarefas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Pessoa Responsável</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $task->id }}</th>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->username }}</td>
                        <td><a class="btn btn-info" href="{{ route('tasks.view', $task->id) }}">Ver</a></td>
                        <td><a class="btn btn-danger" href="{{ route('tasks.delete', $task->id) }}">Apagar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
