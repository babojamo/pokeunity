<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokeunity - Pokemon Community</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--Fontawesome-->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" />

    <link href="{{ asset('css/reactions.css') }}" rel="stylesheet">

    @yield('header')
    
</head>

<body>

    <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <p class="h5 my-0 me-md-auto fw-normal">Pokeunity</p>

        @auth
        <nav class="my-2 my-md-0 me-md-3">
            <a class="p-2 text-dark" href="{{ route('pokemons') }}">Pokemons</a>
            <a class="p-2 text-dark" href="{{ route('community') }}">Community</a>
            <a class="p-2 text-dark" href="{{ route('profile') }}">My Profile</a>
        </nav>
        <a class="btn btn-outline-primary" href="#" onclick="$('#logout').submit();">Logout</a>
        <form action="{{ route('logout') }}" id="logout" method="post">@csrf</form>
        @endauth
    </header>

    <main class="container">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    @yield('footer')
</body>

</html>
