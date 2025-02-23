@extends('layouts.main_layout')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="table-section">
    <div>
        <h2 class="table-title">Bands</h2>
        <form>
            <input type="text" id="" name="search" value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Band Name</th>
                <th scope="col">Number of Albums</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allBands as $band)
                <tr>
                    <td>
                        @if($band->image)
                            <img src="{{ asset('img/bands/' . $band->image) }}" alt="{{ $band->name }}" width="100">
                        @else
                            <img src="{{ asset('img/bands/default.jpg') }}" alt="No image" width="100">
                        @endif
                    </td>
                    <td>{{ $band->name }}</td>
                    <td>{{ DB::table('albums')->where('band_id', $band->id)->count() }}</td>
                    <td><a class="btn btn-info" href="{{ route('bands.view', $band->id) }}">Albums</a></td>
                    <td><a class="btn btn-danger" href="{{ route('bands.delete', $band->id) }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
