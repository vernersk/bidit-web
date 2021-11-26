<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BidIT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-custom shadow-lg">
            <div class="container">
                <a id="site-name" class="navbar-brand d-inline-block" href="{{ url('/') }}">
                    <div>Bid<span class="font-weight-bold">IT</span></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="navbar-nav"></div>

                    <div class="navbar-nav justify-content-center w-100">
                        @auth
                            <ul id="header-navigation" class="navbar-nav">
                                <li class="nav-item">
                                    <a href="{{route('auction.index')}}" class="h5 text-decoration-none font-weight-bold px-4">
                                        HOME
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('bid.index')}}" class="h5 text-decoration-none font-weight-bold px-4">
                                        MY BIDS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('my-wins')}}" class="h5 text-decoration-none font-weight-bold px-4">
                                        MY WINS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('cart')}}" class="h5 text-decoration-none font-weight-bold px-4">
                                        CART
                                    </a>
                                </li>
                            </ul>
                        @endauth
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="h5 nav-link font-weight-bold px-4" href="{{ route('login') }}">{{ strtoupper(__('Login')); }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="h5 nav-link font-weight-bold px-4" href="{{ route('register') }}">{{ strtoupper(__('Register')); }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropright">
                                <a id="navbarDropdown" class="h5 nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('my-transactions')}}">Transactions</a>
                                    <a class="dropdown-item" href="{{route('products')}}">Products</a>
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
