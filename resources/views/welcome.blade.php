<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CampusGuard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ffeb3b; /* Soft yellow background */
                color: #212121; /* Dark text for contrast */
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
                transition: background-color 0.5s ease-in-out;
            }

            .full-height {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                flex-direction: column;
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
                transition: transform 0.3s ease;
            }

            .logo:hover {
                transform: scale(1.1); /* Logo scale effect on hover */
            }

            .title {
                font-size: 48px;
                margin-top: 20px;
                color:rgb(145, 191, 228); /* Vibrant pink */
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4); /* Subtle shadow for better visibility */
            }

            .links > a {
                display: inline-block;
                color:rgb(19, 21, 22); /* Blue color for links */
                padding: 10px 15px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                transition: color 0.3s ease, transform 0.3s ease;
            }

            .links > a:hover {
                color: #ff4081; /* Change color on hover */
                transform: scale(1.05); /* Slight scaling on hover */
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
                .logo {
                    margin-top: 50px; /* Increase margin on smaller screens */
                 }
            }

            /* Background gradient */
            body {
                background: linear-gradient(to right,rgb(76, 238, 84), #8e24aa); /* Gradient from pink to purple */
                color: #fff;
                position: relative;
            }

            /* Overlay for contrast */
            body::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.3); /* Dark overlay for contrast */
                z-index: -1; /* Ensure overlay is below content */
            }

            .card {
                background-color: #ffffff;
                color: #212121;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                margin: 10px;
                transition: transform 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px); /* Elevate card on hover */
            }

            footer {
                text-align: center;
                margin-top: 30px;
                font-size: 14px;
                color:rgb(13, 10, 10);
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
                            <a href="{{ secure_url('/home') }}">Home</a>
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
                <img src="{{ secure_asset('image/image.png') }}" class="logo" alt="UiTM Logo" width="200">
            </div>

            <!-- Title -->
            <div class="content">
                <div class="title m-b-md">
                    CampusGuard
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

            <!-- Footer -->
            <footer>
                © 2024 Universiti Teknologi MARA
            </footer>
        </div>
    </body>
</html>

