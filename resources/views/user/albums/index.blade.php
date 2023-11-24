<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         
            <!-- alert-success is a component I created to display a success message that may be sent from the controller.
            For example, when a publisher is deleted, a message like "Publisher Deleted Successfully" will be displayed -->
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
        
            <x-primary-button>
                <a href="{{ route('user.albums.create') }}">Add a Album</a>
            </x-primary-button>

            @forelse ($albums as $album)
                <x-card>
                  
                        <a href="{{ route('user.albums.show', $album) }}" class="font-bold text-2xl">{{ $album->name }}</a>
            
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">ID:</span> {{ $album->id }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">Name:</span> {{ $album->name }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">Length:</span> {{ $album->length }}
                        </p>
            
                </x-card>   
            @empty
                <p>No albums</p>
            @endforelse
            
        </div>
    </div>
</x-app-layout>