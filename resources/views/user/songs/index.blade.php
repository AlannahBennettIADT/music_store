<!-- Index Page View-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Songs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Created Song Success Alert (shows when song is created) -->
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>
            
            <!-- making the Add song and Sorting on the same page -->

            <div style="display: flex; align-items: center;">
            <!-- Add a song button, routes to create view -->

            <!-- Add spacing between the link and the form -->
            <div style="margin-left: 50px;"></div>

            <!-- Filtering form with a dropdown menu for sorting -->

            <!-- HTML method get - getting the songs queried,
            sort order is called in song controller to see if user queries,
            if request is a Blade template directive that starts an "if" statement. It checks if the value of the 'sort_order' 
            -->

            <!-- 
                OLD - BEFORE USER AUTHENTICATION
                
            
            <form action="{{ url('/songs') }}" method="get">
                <label for="sort_order" class="inline-flex items-centerfont-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Sort by Song Name:</label>
                <select name="sort_order" id="sort_order">
                    <option value="asc" @if(request('sort_order') == 'asc') selected @endif>Ascending</option>
                    <option value="desc" @if(request('sort_order') == 'desc') selected @endif>Descending</option>
                </select>
                <input type="submit" class="sort-button" value="Sort">
            </form>  -->
 


        <form action="{{ auth()->user()->hasRole('admin') ? route('admin.songs.index') : route('user.songs.index') }}" method="get">
            <label for="sort_order" class="inline-flex items-center font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Sort by Song Name:
            </label>
            <select name="sort_order" id="sort_order">
                <option value="asc" @if(request('sort_order') == 'asc') selected @endif>Ascending</option>
                <option value="desc" @if(request('sort_order') == 'desc') selected @endif>Descending</option>
            </select>
            <input type="submit" class="sort-button" value="Sort">
        </form>
</div> 

  

            <!-- Display every song 
                Blade directives: shortcuts for PHP loops -->

            @forelse ($songs as $song)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('user.songs.show', $song) }}">{{ $song->song_name }}</a>
                    </h2>
                    <p class="mt-2">
                    <h3 class="font-bold text-1x1"> <strong> Album </strong>
                        {{$song->album->name}} </h3>
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

            <!-- Pagination links -->
            <div class="pagination">
                {{ $songs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>