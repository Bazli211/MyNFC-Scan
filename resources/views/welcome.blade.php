<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyNFC Scan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .full-height {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .logo {
                margin-top: 20px;
            }

            .title {
                font-size: 48px;
                margin-top: 20px;
            }

            .links > a {
                display: inline-block;
                color: #636b6f;
                padding: 10px 15px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .title {
                    font-size: 36px;
                }
                .links > a {
                    font-size: 12px;
                }
            }

            /* Default Light Mode */
            body {
                background-color: #ffffff;
                color: #000000;
            }

            .card {
                background-color: #f8f9fa;
                color: #000000;
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

            /* Button styles */
            .toggle-dark-mode {
                cursor: pointer;
                padding: 10px 20px;
                background-color: #007bff;
                color: #ffffff;
                border: none;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .toggle-dark-mode:hover {
                background-color: #0056b3;
            }

            footer {
                text-align: center;
                margin-top: 30px;
                font-size: 14px;
                color: #999;
            }
        </style>
    </head>
    <body>
        <div class="full-height">
        <!-- Top Navigation -->
<div class="top-right links">
    @if (Route::has('login'))
        @auth
            @if (Auth::user()->matric_number)
                <a href="{{ route('student.dashboard') }}">Student Dashboard</a>
            @elseif (Auth::user()->staff_id)
                <a href="{{ route('police.dashboard') }}">Police Dashboard</a>
            @else
                <a href="{{ url('/home') }}">Home</a>
            @endif
        @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    @endif
</div>

            <!-- UiTM Logo -->
            <div class="flex-center">
                <img src="{{ asset('image/image.png') }}" class="logo" alt="UiTM Logo" width="250">
            </div>

            <!-- Title -->
            <div class="content">
                <div class="title m-b-md">
                    MyNFC Scan
                </div>

                <!-- Links -->
                <div class="links">
                    <a href="https://mystudent.uitm.edu.my/login">MyStudent</a>
                    <a href="https://simsweb.uitm.edu.my/SPORTAL_APP/SPORTAL_LOGIN/index_login.htm">iStudent Portal</a>
                    <a href="https://ufuture.uitm.edu.my/home/">UFUTURE</a>
                    <a href="https://uaps.uitm.edu.my/home.html">UAPS</a>
                    <a href="https://perlis.library.uitm.edu.my/">Library</a>
                    <a href="https://www.instagram.com/uitmperlis_official/">Instagram</a>
                </div>
            </div>

            <!-- Dark Mode Button -->
            <div class="flex-center">
                <button class="toggle-dark-mode" onclick="toggleDarkMode()">Toggle Night Mode</button>
            </div>

            <!-- Footer -->
            <footer>
                © 2024 Universiti Teknologi MARA
            </footer>
        </div>

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

            // Load the user's preference
            document.addEventListener('DOMContentLoaded', () => {
                if (localStorage.getItem('theme') === 'dark') {
                    document.body.classList.add('dark-mode');
                }
            });
        </script>
    </body>
</html>
