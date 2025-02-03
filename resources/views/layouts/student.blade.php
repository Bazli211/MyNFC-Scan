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

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<style>
    /* Body Styling */
    body {
        background-color: #f0f4f8; /* Light grayish-blue for a subtle, calming effect */
        color: #333333; /* Dark gray for better contrast and readability */
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    /* Card Styling */
    .card {
        background-color: #ffffff; /* Bright white for a clean card look */
        color: #4a4a4a; /* Medium gray text */
        padding: 20px;
        margin: 15px;
        border-radius: 10px; /* Smooth rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px); /* Slight lift on hover */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff; /* Bright blue */
        color: #ffffff; /* White text for contrast */
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px; /* Smooth rounded corners */
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker blue for hover state */
        transform: translateY(-2px); /* Slight lift on hover */
    }

    .btn-primary:focus {
        outline: none;
        box-shadow: 0 0 5px #007bff; /* Focus shadow for accessibility */
    }

    /* Adjust Spacing Between Buttons */
    .btn-primary + .btn-primary {
        margin-left: 1rem; /* Spacing between consecutive buttons */
    }
        /* Navbar Toggler Styling */
        .navbar-toggler {
        border: none; /* Removes default border */
        background-color: #0d47a1; /* Dark blue background */
        color: #ffffff; /* White icon for visibility */
        padding: 10px;
        border-radius: 5px; /* Smooth rounded corners */
        font-size: 1.2rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .navbar-toggler:hover {
        background-color: #1565c0; /* Slightly lighter blue on hover */
        color: #ffeb3b; /* Yellow icon on hover */
    }

    .navbar-toggler:focus {
        outline: none; /* Removes focus outline */
        box-shadow: 0 0 5px #0d47a1; /* Adds a focus shadow for accessibility */
    }
</style>
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
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a>
                    </li>
                @endauth
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicles.index') }}">Vehicle</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('stickers.index') }}">Sticker</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('fine_status.index') }}">List of Offences</a>
                    </li>
            </ul>

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
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    {{ __('Profile') }}
                </a>
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
</html>
