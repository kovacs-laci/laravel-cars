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
            <form action="{{ route('locale.switch') }}" method="post">
                @csrf
                <select name="locale" onchange="this.form.submit()">
                    <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="hu" {{ App::getLocale() == 'hu' ? 'selected' : '' }}>Magyar</option>
                    <!-- Add more languages as needed -->
                </select>
            </form>
            <nav>
                <ul>
                    <li><a href="{{ route('vehicles.index') }}">{{ __('messages.vehicles') }}</a></li>
                    <li><a href="{{ route('makers.index') }}">{{ __('messages.makers') }}</a></li>
                    <li><a href="{{ route('models.index') }}">{{ __('messages.model') }}</a></li>
                    <li><a href="{{ route('trims.index') }}">{{ __('messages.trims') }}</a></li>
                    <li><a href="{{ route('bodies.index') }}">{{ __('messages.bodies') }}</a></li>
                    <li><a href="{{ route('transmissions.index') }}">{{ __('messages.transmissions') }}</a></li>
                    <li><a href="{{ route('fuels.index') }}">{{ __('messages.fuels') }}</a></li>
                    @if(auth()->check())
                        <li>
                            <form class="logout" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit">{{ __('messages.logout') }}</button>
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
