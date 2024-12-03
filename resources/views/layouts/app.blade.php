<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MyNFC Scan</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Night Mode Styles -->
    <style>
        /* Default (Light Mode) */
        body {
            background-color: #ffffff;
            color: #000000;
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #f8f9fa;
            color: #000000;
            margin: 10px;
            padding: 15px;
            border-radius: 8px;
        }

        /* Night Mode */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .card.dark-mode {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        /* Navbar */
        .navbar {
            flex-wrap: wrap;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .nav-item {
            margin-left: 10px;
        }

        .toggle-dark-mode {
            cursor: pointer;
            padding: 8px 15px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            margin-left: auto;
        }

        .toggle-dark-mode:hover {
            background-color: #0056b3;
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
                    MyNFC Scan
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Night Mode Toggle -->
                    <button class="toggle-dark-mode" onclick="toggleDarkMode()">Toggle Night Mode</button>

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

    <!-- JavaScript for Night Mode -->
    <script>
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');

            // Save the preference to localStorage
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }

        // Load the user's preference on page load
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
