<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background: #1cefff;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right bottom, #1cefff, #FFFFFF);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right bottom, #1cefff, #FFFFFF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 20px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover {
                color: #000000;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('app') }}">@lang('item.start')</a>
                    @else
                        <a href="{{ route('login') }}">@lang('item.login_button')</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">@lang('item.register')</a>
                        @endif
                    @endauth
                    <a id="changeLanguage" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @lang('item.language'): <span class="text-uppercase">{{Session::has('web_language') ? Session::get('web_language') : 'EN'}}</span> <span class="caret"></span>
                    </a>
                    <form class="p-2 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" action="{{ route('changeLanguage') }}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit" name="locale" value="en"><span class="flag-icon flag-icon-gb mr-1"></span>English</button>
                            <button class="dropdown-item" type="submit" name="locale" value="vi"><span class="flag-icon flag-icon-vn mr-1"></span>Vietnamese</button>
                    </form>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}
                </div>

                <div class="links">
                <a class="badge badge-pill badge-primary p-3 text-light" href="{{ route('login')}} ">@lang('item.start')</a>
                    <a href="#">@lang('item.download')</a>
                    <a href="#">@lang('item.social')</a>
                    <a href="#">@lang('item.about')</a>
                </div>
            </div>
        </div>
    </body>
</html>
