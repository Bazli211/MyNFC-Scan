<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CampusGuard</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

    <style>
    body {
        background-color: #e3f2fd; /* Light blue background */
        color: #0d47a1; /* Dark blue text for contrast */
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .card {
        background-color: #ffffff; /* White card background */
        color: #424242; /* Neutral text color */
        margin: 10px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px); /* Slight lift on hover */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
    }

    /* Navbar */
    .navbar {
        background-color: #0d47a1; /* Dark blue background */
        color: #ffffff; /* White text */
        display: flex;
        flex-wrap: wrap;
        padding: 10px 20px;
    }

    .navbar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ffffff; /* White text for brand */
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .navbar-brand:hover {
        color: #ffeb3b; /* Yellow highlight on hover */
    }

    .nav-item {
        margin-left: 15px;
    }

    .nav-item a {
        color:rgb(6, 6, 6); /* White text for links */
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    .nav-item a:hover {
        color: #ffeb3b; /* Yellow text on hover */
    }

    /* Dark mode toggle button */
    .toggle-dark-mode {
        background-color: #ffeb3b; /* Yellow background */
        color: #0d47a1; /* Dark blue text */
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .toggle-dark-mode:hover {
        background-color: #fdd835; /* Slightly darker yellow */
        color: #ffffff; /* White text on hover */
    }

    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .toggle-dark-mode {
            width: 100%;
            margin: 10px 0;
            font-size: 1rem;
            padding: 10px;
            text-align: center;
        }

        .navbar .nav-item {
            margin-left: 0;
            margin-bottom: 5px;
        }

        .container {
            flex-direction: column;
        }

        .navbar-collapse {
            justify-content: center;
            width: 100%;
        }

        .navbar-brand {
            margin-bottom: 10px;
        }
    }
</style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
            CampusGuard
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
