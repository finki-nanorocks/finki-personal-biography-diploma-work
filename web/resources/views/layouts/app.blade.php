<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/thasadith.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    @yield('css')
</head>
<body>
@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/mdf_logo.png') }}" alt="logos" class="img-fluid d-block mx-auto w-50">
        </a>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link disabled small text-dark" href="{{ url('/home') }}">
                        <span>УКИМ</span> / <span>Медицински факултет</span> / <strong>Наставен кадар</strong>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                @if (Route::has('login'))
                    <div class="top-right links">
                        <ul class="navbar-nav mr-auto small text-uppercase">
                            @auth
                                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('home') }}">Дома <i class="fas fa-home"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Одјави ме <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Најава <i
                                                class="fas fa-sign-in-alt"></i></a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                @endif
            </ul>
        </div>
    </nav>
@show
<div id="main-section" class="pb-5 mb-5">
    @yield('content')
</div>
@section('footer')
    <footer class="bg-dark text-light container-fluid p-2 fixed-bottom">
        <div class="text-center small text-muted">
            Изработено од Андреј Нанков студент на ФИНКИ.
        </div>
    </footer>
@show
<!-- JS -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/poper.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
@yield('js')
</body>
</html>