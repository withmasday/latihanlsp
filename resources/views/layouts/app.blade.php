<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white rounded-end fixed-top">
            <div class="container">
                <a class="navbar-brand text-primary" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('index') ? 'active' : '' }}" href="{{ route('index') }}">{{ __('Beranda') }}</a>
                        </li>
                        @else
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('product.index') ? 'active' : '' }}" href="{{ route('product.index') }}">{{ __('Product') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('order.index') ? 'active' : '' }}" href="{{ route('order.index') }}">{{ __('Order') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('index') ? 'active' : '' }}" href="{{ route('index') }}">{{ __('Beranda') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('order.allwhistlist') ? 'active' : '' }}" href="{{ route('order.allwhistlist') }}">{{ __('Whistlist') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('order.orderindex') ? 'active' : '' }}" href="{{ route('order.orderindex') }}">{{ __('Order') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('index') }}">{{ __('Transaction History') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-primary" href="{{ route('login') }}">{{ __('Order? Sign In Here') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        <main class="py-5 mt-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    @yield('javascript')
    @if (\Session::has('success'))
        <script type="text/javascript">
            Swal.fire(
                "Successfully!",
                "{!! \Session::get('success') !!}",
                "success"
            );
        </script>
    @endif

    @if (\Session::has('error'))
        <script type="text/javascript">
            Swal.fire(
                "Failed!",
                "{!! \Session::get('error') !!}",
                "error"
            );
        </script>
    @endif
</body>
</html>
