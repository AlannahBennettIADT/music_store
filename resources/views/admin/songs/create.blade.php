<!-- Create Song View-->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Song') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <!-- routing to store after submitting, POST HTTP request, multipart for the file and input data -->
                <form action="{{ route('admin.songs.store') }}" method="post" enctype="multipart/form-data">

                    <!-- CSRF- Cross Site Request Forgeries (Middleware detecting CSRF tokens to make sure 
                    the same user that is submitting the form is the same that is using the session) -->

                    @csrf
                    <x-text-input
                        type="text"
                        name="song_name"
                        field="song_name"
                        placeholder="Song Name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('song_name')"></x-text-input>

                    <x-text-input
                        type="time"
                        name="song_length"
                        field="song_length"
                        placeholder="Song Length..."
                        class="w-full mt-6"
                        :value="@old('song_length')"></x-text-input>

                    <!-- I created a new component called textarea, you will need to do the same to using the x-textarea component -->
                    <x-textarea
                        type="text"
                        name="song_description"
                        rows="5"
                        field="song_description"
                        :value="@old('song_description')"
                        placeholder="Song Description"
                        class="w-full mt-6"></x-textarea>

                  <!-- Created file input component to upload song covers. -->
                    <x-song-cover
                        type="file"
                        name="song_image"
                        placeholder="Song Cover"
                        class="w-full mt-6"
                        field="song_image"
                        :value="old('song_image')">>
                    </x-song-cover>

                    <div class="mt-6">
                    <label for="album_id"> <strong>Album</strong> <br> </label>
                        <x-select-album name="album_id" :albums="$albums" :selected="old('album_id')"/>
                    </div>

                    <div class="form-group">
                        <br>
                        <label for="artists"> <strong>Artists</strong> <br> </label>
                        @foreach($artists as $artist)
                            <input type="checkbox" value="{{$artist->id}}" name="artists[]">
                            {{$artist->artist_name}}
                        @endforeach
                    </div>

                    <x-primary-button class="mt-6">Save Song</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>