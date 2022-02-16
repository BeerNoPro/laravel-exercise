<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @guest
        <title>Custom Auth</title>
    @else
        @php
            $user = auth()->user()->name;
        @endphp
        <title>Hello {{ $user }}</title>
    @endguest
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            @guest
                <a class="navbar-brand mr-auto" href="#">Laravel 8 custom Auth</a>
            @else
                @php
                    $user = auth()->user()->name;
                @endphp
                <a class="navbar-brand mr-auto" href="#">{{ $user }}</a>
            @endguest
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <div class="container">
        @if (!auth()->guest())
            <div class="text-center">
                <h1>Welcome to home page</h1>
            </div>
        @endif
    </div>
</body>
</html>