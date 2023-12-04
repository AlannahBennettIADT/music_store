<!-- Edit Song View -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Song') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <!-- routing to update function in songs -->
                <form action="{{ route('editor.songs.update',$song) }}" method="post" enctype="multipart/form-data">

                     <!-- laravel hidden method, adds input field which laravel changes method to put instead of post -->
                    @method('put')

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
                        :value="@old('song_name',$song->song_name)">
                    </x-text-input>

                    <x-text-input
                        type="time"
                        name="song_length"
                        field="song_length"
                        placeholder="Song Length..."
                        class="w-full mt-6"
                        :value="@old('song_length',$song->song_length)">
                    </x-text-input>

                    <!-- I created a new component called textarea, you will need to do the same to using the x-textarea component -->
                    <!-- Added type = "text" -->
                    <x-textarea
                        type="text"
                        name="song_description"
                        rows="10"
                        field="song_description"
                        placeholder="song description..."
                        class="w-full mt-6"
                        :value="@old('song_description',$song->song_description)">
                    </x-textarea>


                    <!-- Created file input component -->
                    <x-song-cover
                        type="file"
                        name="song_image" 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        placeholder="Song Image"
                        field="song_image"
                        :value="old('song_image', $song->song_image)">
                    </x-song-cover>

                    <!-- <div class="mt-6">
                        <x-select-album name="album_id" :albums="$albums" :selected="old('album_id')"/>
                    </div> -->


                    <img src="{{asset($song->song_image)}}" alt="{{ $song->song_name }}" width="100">

                    <x-primary-button class="mt-6">Save Song</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
