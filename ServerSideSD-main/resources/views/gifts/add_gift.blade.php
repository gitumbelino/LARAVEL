@extends('layouts.fo_layout')
@section('content')


<section class="form-section">
    <h2>Adicionar Prenda</h2>
<div>
    <form method="POST" action="{{route('gifts.create')}}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Prenda</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="expected_value" class="form-label">Valor Previsto</label>
            <input type="number" step="0.01" name="expected_value" class="form-control" id="expected_value" required>
        </div>

        <div class="mb-3">
            <label for="spent_value" class="form-label">Valor Gasto</label>
            <input type="number" step="0.01" name="spent_value" class="form-control" id="spent_value" required>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Utilizador</label>
            <select class="form-select" name="user_id" id="user_id" required>
                <option value="">Para quem é?</option>
                @foreach ($usersSelection as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
</section>





@endsection
