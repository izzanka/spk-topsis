<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Sistem Pendukung Keputusan')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

    </head>
    <body>

    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <b>Sistem Pendukung Keputusan</b>
            </a>

            <ul class="nav nav-pills">
                @guest
                    {{-- <li class="nav-item"><a href="{{ route('register') }}" class="nav-link {{ request()->route()->named('register') ? 'active' : '' }}">Register</a></li> --}}
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link {{ request()->route()->named('login') ? 'active' : '' }}">Login</a></li>
                @else
                    <x-alternatif-component/>
                    <x-criteria-component/>
                    <x-sub-criteria-component/>
                    <li class="nav-item"><a href="{{ route('alternatif.values.index') }}" class="nav-link {{ request()->route()->named('alternatif.values.index') || request()->route()->named('alternatif.values.edit') ? 'active' : '' }}">Nilai Alternatif</a></li>
                    <li class="nav-item"><a href="{{ route('calculations.index') }}" class="nav-link {{ request()->route()->named('calculations.index') ? 'active' : '' }}">Perhitungan</a></li>
                    <li class="nav-item"><a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                @endguest
            </ul>
        </header>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
