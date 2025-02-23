@extends('layouts.main_layout')
@section('content')
    <section class="form-section">
        <h2>Edit Album</h2>
        <div>
            <form method="POST" action="{{ route('albums.update', $album->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Album Name</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $album->name }}">
                </div>

                <div class="mb-3">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" class="form-control" id="release_date"
                        value="{{ $album->release_date }}">
                </div>

                <div class="mb-3">
                    <label for="band_id" class="form-label">Band</label>
                    <select name="band_id" class="form-control" id="band_id">
                        @foreach($bands as $band)
                            <option value="{{ $band->id }}"
                                {{ $album->band_id == $band->id ? 'selected' : '' }}>
                                {{ $band->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image Name</label>
                    <input type="text" name="image" class="form-control" id="image"
                        value="{{ $album->image }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Album</button>
                <a href="{{ route('albums.all') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </section>
@endsection
