@extends('layouts.fo_layout')
@section('content')

<section class="form-section">
    <h2>Adicionar tarefa</h2>
    <div>
        <form method="POST" action="{{route('task.create')}}">
            @csrf

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Task's Title</label>
              <input type="text" name="name" class="form-control" id="task-title" aria-describedby="">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="task-description" aria-describedby="">
              </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Due Date</label>
                <input type="date" name="due_at" class="form-control" id="task-date">
                <label for="exampleSelect">Escolha uma opção de</label>
            <select class="form-select" name="user_id" aria-label="Default select example">
                <option selected>User</option>

                @foreach ($usersSelection as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach

              </select>
              <br>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

</section>





@endsection
