<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Daig Webapp') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
    <!-- Scripts end -->

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Fonts end -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <!-- Styles end -->
</head>
<body>
<div id="app">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" id="top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navigation-list">
                <li class="navigation-item {{ Request::segment(1) === 'index' ? 'nav-active' : null }}">
                    <a href="{{ route('index') }}">
                        <i class="fa fa-2x fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="navigation-item {{ Request::segment(1) === 'tips' ? 'nav-active' : null }}">
                    <a href="{{ route('tips.index') }}">
                        <i class="fas fa-lightbulb"></i>
                        <span>Tips</span>
                    </a>
                </li>
                <li class="navigation-item {{ Request::segment(1) === 'docs' ? 'nav-active' : null }}">
                    <a href="{{ route('docs.index') }}">
                        <i class="fas fa-book-open"></i>
                        <span>Documents</span>
                    </a>
                </li>
                <li class="navigation-item {{ Request::segment(1) === 'recommendations' ? 'nav-active' : null }}">
                    <a href="{{ route('recommendations.index') }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Places</span>
                    </a>
                </li>
                <li class="navigation-item {{ Request::segment(1) === 'activity' ? 'nav-active' : null }}">
                    <a href="{{ route('activity.index') }}">
                        <i class="fas fa-hiking"></i>
                        <span>Activities</span>
                    </a>
                </li>
                <li class="navigation-item {{ Request::segment(1) === 'settings' ? 'nav-active' : null }}">
                    <a href="{{ route('settings.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="navigation-item {{ Request::segment(1) === 'help' ? 'nav-active' : null }}">
                    <a href="{{ route('help.index') }}">
                        <i class="far fa-question-circle"></i>
                        <span>Help</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navigation end -->

@yield('slider')

<!-- Content -->
    <main class="container py-4 text-center">
        @yield('content')
    </main>
    <!-- Content end -->

    <!-- Footer -->
    <footer class="footer mt-auto py-3 border-top text-center">
        <div class="container">
            <p><a href="{{ route('impressum') }}">Impressum</a> |
            <a href="{{ route('terms') }}">Terms & Conditions</a> |
            <a href="{{ route('privacy') }}">Privacy</a> |
            <a href="{{ route('admin') }}">Administration</a> | &copy; 2020
                <a href="https://www.halfmannshof-gelsenkirchen.de/"> Künstlersiedlung Halfmannshof</a></p>
        </div>
    </footer>
    <!-- Footer end -->
</div>

</body>
</html>
