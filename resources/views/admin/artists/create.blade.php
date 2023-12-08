<!-- Create Admin Artist View-->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <!-- routing to store after submitting, POST HTTP request, multipart for the file and input data -->
                <form action="{{ route('admin.artists.store') }}" method="post" enctype="multipart/form-data">

                    <!-- CSRF- Cross Site Request Forgeries (Middleware detecting CSRF tokens to make sure 
                    the same user that is submitting the form is the same that is using the session) -->

                    @csrf

                    
                    <x-text-input
                        type="text"
                        name="artist_name"
                        field="artist_name"
                        placeholder="Artist Name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('artist_name')"></x-text-input>

                    <!-- I created a new component called textarea, you will need to do the same to using the x-textarea component -->

                    <x-text-input
                        type="text"
                        name="management"
                        field="management"
                        placeholder="Management"
                        class="w-full mt-6"
                        :value="@old('management')"></x-text-input>

                        <x-text-input
                        type="text"
                        name="monthly_listeners"
                        field="monthly_listeners"
                        placeholder="Monthly Listeners"
                        class="w-full mt-6"
                        :value="@old('monthly_listeners')"></x-text-input>

                        <x-text-input
                        type="text"
                        name="country"
                        field="country"
                        placeholder="Country"
                        class="w-full mt-6"
                        :value="@old('country')"></x-text-input>
                  <!-- Created file input component to upload artist covers. -->
                  <x-song-cover
                        type="file"
                        name="artist_image"
                        placeholder="Artist Image"
                        class="w-full mt-6"
                        field="artist_image"
                        :value="old('artist_image')">>
                    </x-song-cover>


                    <x-primary-button class="mt-6">Save Artist</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

