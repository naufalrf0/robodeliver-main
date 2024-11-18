<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Home' }} | Robodeliver</title>
    <meta name="description" content="{{ $metaDescription ?? 'Default Description' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'Robodeliver Inc.' }}">
    @stack('meta')

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon-57x57-precomposed.png') }}" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon-72x72-precomposed.png') }}" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon-114x114-precomposed.png') }}" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon-144x144-precomposed.png') }}" sizes="144x144">

    @include('home.partials.styles')
    @stack('styles')
</head>

<body>
    {{-- Header Section --}}
    @include('home.partials.header', ['navigation' => $headerNavigation])

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer Section --}}
    @include('home.partials.footer', ['navigation' => $footerNavigation])

    {{-- Scroll to Top Button --}}
    <div id="toTop"></div>

    {{-- Default Scripts --}}
    @include('home.partials.scripts')

    {{-- Custom Scripts --}}
    @stack('scripts')
</body>

</html>
