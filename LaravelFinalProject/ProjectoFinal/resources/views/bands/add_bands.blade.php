@extends('layouts.main_layout')
@section('content')
<div>
    <form method="POST" action="{{ route('bands.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Band Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image Name</label>
            <input type="text" name="image" class="form-control" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Add Band</button>
    </form>
</div>
@endsection
