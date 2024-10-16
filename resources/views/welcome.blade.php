<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @endif
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 centered">
                <h1>LikaProgramming</h1>
                <div class="box-laravel">
                    <span>Laravel Version: <b>{{ app()->version() }}</b> </span>
                </div>
                <div class="box-php">
                    <span>PHP Version: <b>{{ PHP_VERSION }}</b> </span>
                </div>
                <div class="box-memory">
                    <span>Current Usage: <b>{{ round(memory_get_usage() / 1024 / 1024, 2) }} MB</b> </span>
                    <span>Peak Usage: <b>{{ round(memory_get_peak_usage() / 1024 / 1024, 2) }} MB</b> </span>
                    <span>Duration: <b> {{ round((microtime(true) - LARAVEL_START) * 1000, 2) }} ms</b> </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
