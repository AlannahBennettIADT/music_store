<!-- DELETE BUTTON:
    On submit: will return a confirmation window
    CSRF - checking same user session is the same user deleting song
    method('DELETE') - HTTP request method -->

@props(['route', 'text' => 'Delete'])

<form method="POST" action="{{ $route }}" onsubmit="return confirm('Are you sure you want to delete this item?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">{{ $text }}</button>
</form>



