@extends('layouts.app')
@section('content')
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->

    <div class = "container">
        <h1>View Songs </h1>
        <table class = 'table'>
        <tbody>
            <tr>
                <td> <strong> Title </strong></td>
                <td>{{ $song->song_name}} </td>
            </tr>


            <tr>
                <td> <strong> Description </strong></td>
                <td>{{ $song->song_description}} </td>
            </tr>

            <tr>
                <td> <strong> Length </strong></td>
                <td>{{ $song->song_length}} </td>
            </tr>

            <tr>
                <td> <strong> Cover </strong></td>
                <td>
                    @if ($song->song_image)
                    <img src="{{ $song->song_image}}"
                    alt="{{ $song->title}}" width="100">
                    @else
                        No Image
                    @endif
                </td>
            </tr>

        </tbody>
        </table>
    </div>
@endsection