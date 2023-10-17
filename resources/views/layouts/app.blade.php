<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Song</title>

 

    <link rel = "stylesheet" href = "{{ asset('css/styles.css') }}">

</head>

<body>
    <header>

        <nav>

        <ul>

            <li><a href ="{{route('songs.index')}}">All Songs</a></li>

             <li><a href ="{{route('songs.create')}}">Add New Song</a></li>
        </ul>

    </nav>

</header>
 

<main>

    @yield('content')

</main>
</body>

</html>