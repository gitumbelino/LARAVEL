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
        <h2 class="table-title">All Albums</h2>
        <form>
            <input type="text" id="" name="search" value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Album Name</th>
                <th scope="col">Release Date</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allAlbums as $album)
                <tr>
                    <td>
                        <td>
                            Debug path: {{ asset('img/albums/' . $album->image) }}
                            <br>
                            Debug image name: {{ $album->image }}
                            @if($album->image)
                                <img src="{{ asset('img/albums/' . $album->image) }}" alt="{{ $album->name }}" width="100">
                            @else
                                <img src="{{ asset('img/albums/default.jpg') }}" alt="No image" width="100">
                            @endif
                        </td>
                    </td>
                    <td>{{ $album->name }}</td>
                    <td>{{ $album->release_date }}</td>
                    <td><a class="btn btn-info" href="{{ route('albums.view', $album->id) }}">View</a></td>
                    <td>
                        @if(Auth::check() && Auth::user()->user_type === 1)
                            <a class="btn btn-warning" href="{{ route('albums.edit', $album->id) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('albums.delete', $album->id) }}">Delete</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
