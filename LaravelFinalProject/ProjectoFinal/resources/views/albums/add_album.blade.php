@extends('layouts.main_layout')
@section('content')
    <section class="form-section">
        <h2>Add Album</h2>
        <div>
            <form method="POST" action="{{ route('albums.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Album Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" class="form-control" id="release_date" required>
                </div>
                <div class="mb-3">
                    <label for="band_id" class="form-label">Band</label>
                    <select name="band_id" class="form-select" id="band_id" required>
                        <option value="">Select a band</option>
                        @foreach ($bands as $band)
                            <option value="{{ $band->id }}">{{ $band->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
