<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- SUCCESS ALERT -->
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td rowspan="6">
                            <!-- <img src="{{asset('storage/images/' . $song->song_image)}}" width="150" /> -->
                            </td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Song Name  </td>
                                <td>{{ $song->song_name }}</td>
                            </tr>
                           
                            <tr>
                                <td class="font-bold">Song description </td>
                                <td>{{ $song->song_description }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Song Length </td>
                                <td>{{ $song->song_length }}</td>
                            </tr>

                            <tr>
                                <td class="font-bold ">Cover Image </td>
                                <!-- use the asset function, access the file $book->book_image in the folder storage/images -->
                                <td><img src="{{asset($song->song_image)}}" 
                                    alt="{{ $song->song_name }}" width="100"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Added Edit and Delete buttons, routing to specific functions in song controller-->
                    <x-primary-button><a href="{{ route('songs.edit',$song) }}"> Edit</a></x-primary-button>
                    <x-delete-button :route="route('songs.destroy', $song)" text="Delete Song" />

                </div>
            </div>
        </div>
    </div>
</x-app-layout>