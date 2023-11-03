<!-- 
DELETE BUTTON:
    On submit: will return a confirmation window
    CSRF - checking same user session is the same user deleting song
    method('DELETE') - HTTP request method -->

@props(['route', 'text' => 'Delete'])

<form method="POST" action="{{ $route }}" onsubmit="return confirm('Are you sure you want to delete this item?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full">{{ $text }}</button>
</form>
