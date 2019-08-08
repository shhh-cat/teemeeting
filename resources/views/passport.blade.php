<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ optional(Auth::user())->id }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/passport.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <style>
        /* html, body{
            background: #1cefff;
            background-size: cover;
            background: -webkit-linear-gradient(to right bottom, #1cefff, #FFFFFF);
            background: linear-gradient(to right bottom, #1cefff, #FFFFFF);
        } */
        /* .dropleft > .dropdown-menu{
            display: block !important;
        } */
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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
                            <a class="nav-link" href="{{ route('login') }}">@lang('item.login_button')</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">@lang('item.register_button')</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                                <a id="changeLanguage" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @lang('item.language'): <span class="text-uppercase">{{Session::has('web_language') ? Session::get('web_language') : 'EN'}}</span> <span class="caret"></span>
                                </a>
                                <form class="p-2 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" action="{{ route('changeLanguage') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit" name="locale" value="en"><span class="flag-icon flag-icon-gb mr-1"></span>English</button>
                                    <button class="dropdown-item" type="submit" name="locale" value="vi"><span class="flag-icon flag-icon-vn mr-1"></span>Vietnamese</button>
                                </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <div class="dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a id="changeLanguage" class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @lang('item.language'): <span class="text-uppercase">{{Session::has('web_language') ? Session::get('web_language') : 'EN'}}</span><span class="caret"></span>
                                    </a>
                                    <form class="p-2 dropdown-menu dropdown-menu-right" aria-labelledby="changeLanguage" action="{{ route('changeLanguage') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit" name="locale" value="en"><span class="flag-icon flag-icon-gb mr-1"></span>English</button>
                                        <button class="dropdown-item" type="submit" name="locale" value="vi"><span class="flag-icon flag-icon-vn mr-1"></span>Vietnamese</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="app">
            <router-view name="passportClients"></router-view>
            <router-view/>
        </main>
    </div>
</body>
</html>
