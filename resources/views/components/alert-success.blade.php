<!-- 
    Alert Success component used for when song is edited or created :

    session 'success' is called in the song controller when rerouting to another page. 
    In the slot, it displays the message.
-->
@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
    {{ $slot }}
</div>
@endif
