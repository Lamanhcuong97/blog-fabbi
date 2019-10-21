<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
        <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar"></header>
        <div class="container-fluid">
            <div class=row>
                <nav class="col-md-2 d-none d-md-block bg-light sidebar border-right">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <span>{{ __('messages.Post') }}</span>
                        <li class="nav-item" >
                            <a class="nav-link active" href="#">
                            {{ __('messages.ListPost') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            {{ __('messages.Create') }}
                            </a>
                        </li>
                        <span>{{ __('messages.Cagetory') }}</span>
                        <li class="nav-item" >
                            <a class="nav-link" href="#">
                            {{ __('messages.ListCagetory') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            {{ __('messages.Create') }}
                            </a>
                        </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="main-content">
                    <div class="">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
