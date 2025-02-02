@extends('layouts.fo_layout')
@section('content')

<h4>Detalhes da Prenda</h4>

<form method="POST" action="{{route('gifts.update', $gift->id)}}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nome da Prenda</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $gift->name }}" required>
    </div>

    <div class="mb-3">
        <label for="expected_value" class="form-label">Valor Previsto</label>
        <input type="number" step="0.01" name="expected_value" class="form-control" id="expected_value" value="{{ $gift->expected_value }}" required>
    </div>

    <div class="mb-3">
        <label for="spent_value" class="form-label">Valor Gasto</label>
        <input type="number" step="0.01" name="spent_value" class="form-control" id="spent_value" value="{{ $gift->spent_value }}" required>
    </div>

    <div class="mb-3">
        <label for="user_id" class="form-label">Utilizador</label>
        <select class="form-select" name="user_id" id="user_id" required>
            @foreach ($users as $user)
                <option value="{{$user->id}}" {{ $gift->user_id == $user->id ? 'selected' : '' }}>
                    {{$user->name}}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
