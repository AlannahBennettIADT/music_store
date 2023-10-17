@extends('layouts.app')
@section('content')
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->

    <div class = "container">
        <h1>All Songs </h1>
        <table class = 'table'>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
        </thead>
        <tbody>
            @foreach ($songs as $song)
            <tr>
                <td><a href = "{{route('songs.show',$song) }}" >{{ $song->song_name}} </a></td>
                <td> {{ $song->song_description}} </td>
                <td>
                    @if ($song->song_image)
                    <img src="{{ $song->song_image}}"
                    alt="{{ $song->title}}" width="100">
                    @else
                        No Image
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection
