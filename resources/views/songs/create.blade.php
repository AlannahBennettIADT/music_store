@extends('layouts.app')

@section('content')
    <h3 class="text-center">Create Song</h3>
    <form action="{{ route('songs.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="song_name">Song Name</label>
            <input type="text" name="song_name" id="song_name" class="
            form-control {{ $errors->has('song_name') ? 'is-invalid' : '' }}" 
            value="{{ old('song_name') }}" placeholder="Enter Song Name">
            @if($errors->has('song_name'))
                <span class="invalid-feedback">
                    {{ $errors->first('song_name') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="song_length">Song Length</label>
            <input type="time" name="song_length" id="song_length" class="
            form-control {{ $errors->has('song_length') ? 'is-invalid' : '' }}" 
            value="{{ old('song_length') }}" placeholder="Enter Song Length">
            @if($errors->has('song_length'))
                <span class="invalid-feedback">
                    {{ $errors->first('song_length') }}
                </span>
            @endif
        </div>


        <div class="form-group">
            <label for="song_description">Song Description</label>
            <textarea name="song_description" id="song_description" rows="4" class="form-control {{ $errors->has('song_description') ? 'is-invalid' : '' }}" placeholder="Enter Song Description">{{ old('song_description') }}</textarea>
            @if($errors->has('song_description')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{ $errors->first('song_description') }} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="song_image">Song Image</label>
            <input type="text" name="song_image" id="song_image" class="
            form-control {{ $errors->has('song_image') ? 'is-invalid' : '' }}" 
            value="{{ old('song_image') }}" placeholder="Enter Song Image">
            @if($errors->has('song_image'))
                <span class="invalid-feedback">
                    {{ $errors->first('song_image') }}
                </span>
            @endif
        </div>


        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
