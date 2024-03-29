<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lifegrips') }}</title>

    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categories.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <main-navbar></main-navbar>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <a class="nav-link" href="{{ route('shop') }}">Sklep</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            </a>
                            <div class="dropdown-menu" style="width: 300px" aria-labelledby="navbarDropdownMenuLink">
                                <ul class="list-group list-group-root well">
                                    @foreach ($categories as $category)
                                        <li class="list-group-item">{{ $category->name }}</li>
                                        <ul class="list-group">
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('child_category', ['child_category' => $childCategory])
                                        @endforeach
                                        </ul>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item me-3">
                            <form
                                action="/sklep"
                                class="d-flex flex-row-reverse mb-2 float-end"
                                method="get"
                            >
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="me-2 bi bi-search"></i>
                                </button>
                                <input
                                    class="form-control me-2"
                                    type="search"
                                    name="q"
                                    placeholder="Nazwa produktu"
                                    aria-label="Search"
                                />
                            </form>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">Koszyk</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->email }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if( Auth::user()->role == 'admin' || Auth::user()->role == 'employee')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.panel') }}">
                                            {{ __('Zarządzaj') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        {{ __('Mój profil') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj') }}
                                        </a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    {{-- <sub-nav data="" ></sub-nav> --}}

        <main>
            @yield('content')
        </main> 

    </div>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,500&display=swap');       
        body{
            background-color: rgb(255, 255, 255);
            font-family: 'Open Sans', sans-serif;
        }

    </style>

</body>
<script src="{{ asset('js/app.js') }}"></script>

<script>

</script>

</html>
