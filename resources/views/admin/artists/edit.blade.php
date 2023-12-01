<!-- Edit Song View -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <!-- routing to update function in songs -->
                <form action="{{ route('admin.artists.update',$artist) }}" method="post" enctype="multipart/form-data">

                     <!-- laravel hidden method, adds input field which laravel changes method to put instead of post -->
                    @method('put')

                    <!-- CSRF- Cross Site Request Forgeries (Middleware detecting CSRF tokens to make sure 
                    the same user that is submitting the form is the same that is using the session) -->
                    @csrf

                    <x-text-input
                        type="text"
                        name="artist_name"
                        field="artist_name"
                        placeholder="Song Name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('artist_name',$artist->artist_name)">
                    </x-text-input>

                    <x-text-input
                        type="text"
                        name="management"
                        field="management"
                        placeholder="Management"
                        class="w-full mt-6"
                        :value="@old('management',$artist->management)">
                    </x-text-input>

                    <x-text-input
                        type="text"
                        name="monthly_listeners"
                        field="monthly_listeners"
                        placeholder="monthly_listeners"
                        class="w-full mt-6"
                        :value="@old('monthly_listeners',$artist->monthly_listeners)">
                    </x-text-input>
                    <x-text-input
                        type="text"
                        name="country"
                        field="country"
                        placeholder="country"
                        class="w-full mt-6"
                        :value="@old('country',$artist->country)">
                    </x-text-input>


                    <!-- Created file input component -->
                    <x-song-cover
                        type="file"
                        name="artist_image" 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        placeholder="Song Image"
                        field="artist_image"
                        :value="old('artist_image', $artist->artist_image)">
                    </x-song-cover>



                    <img src="{{asset($artist->artist_image)}}" alt="{{ $artist->song_name }}" width="100">

                    <x-primary-button class="mt-6">Save Artist</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
