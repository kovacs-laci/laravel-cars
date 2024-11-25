<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autók</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css') }}" >

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>

<body>
    <header>
        <div>
            <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
        </div>
        <div class="row">
            <img src="{{ asset('img/yellow-car.jpg') }}" alt="logo" width="175" height="100">
            <nav>
                <ul>
                    <li><a href="{{ route('vehicles.index') }}">Járművek</a></li>
                    <li><a href="{{ route('makers.index') }}">Gyártók</a></li>
                    <li><a href="{{ route('models.index') }}">Modellek</a></li>
                    <li><a href="{{ route('trims.index') }}">Típusok</a></li>
                    <li><a href="{{ route('bodies.index') }}">Karosszériák</a></li>
                    <li><a href="{{ route('transmissions.index') }}">Sebváltók</a></li>
                    <li><a href="{{ route('fuels.index') }}">Üzemanyagok</a></li>
                    @if(auth()->check())
                        <li>
                            <form class="logout" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit">Kijelentkezés</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endif

                </ul>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Kovács László</p>
    </footer>

</body>

</html>
