<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$album->name}} - Songs
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-bold text-2x1 mb-4"> Album Details </h3>
            <p class="text-grey-700"><span class="font-bold"> Id: </span> {{$album->id}}</p>
            <p class="text-grey-700"><span class="font-bold"> Name: </span> {{$album->name}}</p>
            <p class="text-grey-700"><span class="font-bold"> Description: </span> {{$album->description}}</p>
            <p class="text-grey-700"><span class="font-bold"> Length: </span> {{$album->length}}</p>
            <p class="text-grey-700"><span class="font-bold"> Type: </span> {{$album->type}}</p>

            <h3 class="font-bold text-2x1 mt-6 mb-4">Songs by {{$album->name}}</h3>

            @forelse ($songs as $song)
                <x-card>
                    <a href="{{route('admin.songs.show',$song)}}" class="font-bold text=2x1"> {{$song->song_name}}</a>
                </x-card>
            @empty
            <p>No Songs for this Album </p>

            @endforelse

            <!-- Added Edit and Delete buttons, routing to specific functions in album controller-->
            <x-primary-button><a href="{{ route('admin.albums.edit',$album) }}"> Edit</a></x-primary-button>
            <x-delete-button :route="route('admin.albums.destroy', $album)" text="Delete Album" />
            
        </div>
    </div>
</x-app-layout>