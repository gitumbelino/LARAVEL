@extends('layouts.main_layout')
@section('content')
<div>
    <h2>{{ $band->name }}</h2>
    <h3>Albums:</h3>
    <table class="table">
        <thead>
            <tr>
                <tr>
                    <th>Album Cover</th>
                    <th>Album Name</th>
                    <th>Release Date</th>
                </tr>
            </tr>
        </thead>
        <tbody>
            @foreach(DB::table('albums')->where('band_id', $band->id)->get() as $album)
            <tr>
                <td>
                    @if($album->image)
                        <img src="{{ asset('img/albums/' . $album->image) }}" alt="{{ $album->name }}" width="100">
                    @else
                        <img src="{{ asset('img/albums/default.jpg') }}" alt="No image" width="100">
                    @endif
                </td>
                <td>{{ $album->name }}</td>
                <td>{{ $album->release_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
