<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @endif
</head>

<body>
    <div class="container">
        <div class="centered">
            <h1>LikaProgramming</h1>
            <button id="mic-button">
                Start Listening
                <ion-icon name="mic" class="ms-1"></ion-icon>
            </button>
            <button>Show Modal</button>
            <code id="code">

            </code>
            <div id="info-container" class="box-laravel">
                <span>Laravel Version: <b>{{ app()->version() }}</b> </span>
                <span>PHP Version: <b>{{ PHP_VERSION }}</b> </span>
                <span>Current Memory Usage: <b>{{ round(memory_get_usage() / 1024 / 1024, 2) }} MB</b> </span>
                <span>Peak Memory Usage: <b>{{ round(memory_get_peak_usage() / 1024 / 1024, 2) }} MB</b> </span>
                <span>Duration: <b> {{ round((microtime(true) - LARAVEL_START) * 1000, 2) }} ms</b> </span>
                <span>Page Loading: <span id="page-loader" class="loader"></span><b id="loading-time"></b>
                </span>
                <span>Current temperature in <span id="city"></span> is: <b id="temperature"></b> </span>
                <div id="quote" class="quote"></div>
            </div>
        </div>

    </div>

</body>

</html>
