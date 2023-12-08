<!-- Edit Admin Album View -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <!-- routing to store after submitting, POST HTTP request, multipart for the file and input data -->
                <form action="{{ route('admin.albums.update',$album) }}" method="post" enctype="multipart/form-data">

                     <!-- laravel hidden method, adds input field which laravel changes method to put instead of post -->
                    @method('put')

                    <!-- CSRF- Cross Site Request Forgeries (Middleware detecting CSRF tokens to make sure 
                    the same user that is submitting the form is the same that is using the session) -->

                    @csrf
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Album Name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name', $album->name)"></x-text-input>

                    <x-text-input
                        type="time"
                        name="length"
                        field="length"
                        placeholder="album Length..."
                        class="w-full mt-6"
                        :value="@old('length',$album->length)">
                    </x-text-input>

                    <!-- I created a new component called textarea, you will need to do the same to using the x-textarea component -->
                    <x-textarea
                        type="text"
                        name="description"
                        rows="5"
                        field="description"
                        :value="@old('description')"
                        placeholder="Album Description"
                        class="w-full mt-6"
                        :value="@old('description',$album->description)">
                    </x-textarea>

                        <x-text-input
                        type="text"
                        name="type"
                        field="type"
                        placeholder="Album type"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('type',$album->type)"></x-text-input>

                    <x-primary-button class="mt-6">Save Album</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


