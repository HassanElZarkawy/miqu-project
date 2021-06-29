<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('APP_NAME') }} - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
</head>

<body>
<div class="app">
    <div class="container-fluid">
        <div class="d-flex full-height p-v-15 flex-column justify-content-between">
            <div class="d-none d-md-flex p-h-40 mb-md-3 mt-3 align-self-start">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.ico') }}" alt="{{ config('APP_NAME') }}" class="app-logo">
                </a>
            </div>
            <div class="container">
                @yield('content')
            </div>
            <div class="d-none d-md-flex  p-h-40 justify-content-between">
                @include('layouts.parts.credits')
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-dark text-link" href="">Legal</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-dark text-link" href="">Privacy</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin/vendors.min.js') }}"></script>

<script src="{{ asset('js/admin/app.min.js') }}"></script>
<script>
    $('.go-back').on('click', function() {
        window.history.back();
    });
</script>

</body>
</html>