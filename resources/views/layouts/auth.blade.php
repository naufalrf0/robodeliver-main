<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription ?? '' }}">
    <meta name="author" content="{{ $metaAuthor ?? '' }}">
    <title>{{ $title ?? 'Robodeliver' }}</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Base CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Specific CSS -->
    <link href="{{ asset('assets/css/order-sign_up.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body id="register_bg">
    <div id="register">
        <aside>
            <figure>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo.png') }}"  height="52" alt="Logo">
                </a>
            </figure>

            {{-- Slot for dynamic content --}}
            {{ $slot }}

            <div class="copy">© {{ date('Y') }} {{ config('app.name', 'Robodeliver') }}</div>
        </aside>
    </div>

    <!-- Common Scripts -->
    <script src="{{ asset('assets/js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('assets/js/common_func.js') }}"></script>
    <script src="{{ asset('assets/js/validate.js') }}"></script>

    @stack('scripts')
</body>
</html>
