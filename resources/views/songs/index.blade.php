<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Songs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Created Song Success Alert -->
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>
            
            <!-- Add a song button, routes to create view -->
            <a href="{{ route('songs.create') }}" class="btn-link btn-lg mb-2">Add a Song</a>


            <!-- Filtering form with a dropdown menu for sorting -->
            <form action="{{ url('/songs') }}" method="get">
                <label for="sort_order">Sort by Song Name:</label>
                <select name="sort_order" id="sort_order">
                    <option value="asc" @if(request('sort_order') == 'asc') selected @endif>Ascending</option>
                    <option value="desc" @if(request('sort_order') == 'desc') selected @endif>Descending</option>
                </select>
                <input type="submit" value="Sort">
            </form>


            <!-- Display every song -->
            @forelse ($songs as $song)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('songs.show', $song) }}">{{ $song->song_name }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ $song->song_description }} <br>
                        {{$song->song_length}} <br>
                        @if ($song->song_image)
                        <img src="{{asset($song->song_image)}}" 
                        alt="{{ $song->song_name }}" width="100">
                    @else
                        No Image
                    @endif
                    </p>

                </div>
            @empty
            <p>No songs</p>
            @endforelse
            
        </div>
    </div>
</x-app-layout>