<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>@lang('layouts.app.name')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @lang('layouts.app.name')
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() === route('tasks.index') ? 'active' : '' }}" href="{{ route('tasks.index') }}">@lang('layouts.app.tasks')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() === route('task_statuses.index') ? 'active' : '' }}" href="{{ route('task_statuses.index') }}">@lang('layouts.app.statuses')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() === route('labels.index') ? 'active' : '' }}" href="{{ route('labels.index') }}">@lang('layouts.app.labels')</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Language switcher -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ App::currentLocale() === 'en' ? 'English' : 'Русский' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('changeLang', ['lang' => 'en']) }}">English</a>
                                <a class="dropdown-item" href="{{ route('changeLang', ['lang' => 'ru']) }}">Русский</a>
                            </div>
                        </li>
                        <div class="vr mx-2 my-2"></div>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() === route('login') ? 'active' : '' }}" href="{{ route('login') }}">@lang('layouts.app.login')</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() === route('register') ? 'active' : '' }}" href="{{ route('register') }}">@lang('layouts.app.register')</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('layouts.app.logout')
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

        <main class="py-4 container">
            @include('flash::message')
            @yield('content')
        </main>

    </div>
    <footer class="mt-auto border-top py-3 flex-shrink-0">
        <div class="container-lg">
            <div class="text-center">
                <a href="https://github.com/Foreachq/task-manager" target="_blank">Site source code</a>
            </div>
        </div>
    </footer>
</body>
</html>
