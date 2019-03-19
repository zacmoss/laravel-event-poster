<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .event-card {
            margin-top: 2rem;
        }
        .btn-red {
            background-color: white;
            border: 1px solid maroon;
            color: maroon;
        }
        .btn-red:hover {
            cursor: pointer;
            background-color: maroon;
            border: none;
            color: white;
        }
        .btn-green {
            background-color: white;
            border: 1px solid green;
            color: green;
        }
        .btn-green:hover {
            cursor: pointer;
            background-color: green;
            border: none;
            color: white;
        }
        .btn:focus {
            outline: none !important;
        }
        .btn:active:focus {
            outline: none !important;
        }
        .link {
            margin-right: 2rem !important;
        }
        .link:hover {
            color: gray !important;
        }
        .event-card .card-header {
            font-weight: 700 !important;
            font-size: 25px !important;
        }
        @media (max-width: 1000px) {
            #filters {
                display: none;
            }
        }
        
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand link"  href="{{ url('/') }}">
                    <!--<img src="logo3.png" width="30px" height="30px">-->
                    EP
                </a>
                @if (Auth::check())
                    <a class='navbar-brand link' href='/eventFeed'>Event Feed</a>
                    @if (Auth::user()->role == 'client')
                        <!--<a class='navbar-brand link' href='/myEvents'>My Events</a>-->
                    @endif
                    <a class='navbar-brand link' href='/createEvent'>Create Event</a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

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
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->role == 'client')
                                        <a class="dropdown-item" href='/myEvents'>My Events</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
