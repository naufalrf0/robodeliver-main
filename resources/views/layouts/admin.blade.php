<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TEK59">
    <title>{{ $title ?? 'Robodeliver - Admin dashboard' }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/admin_layout/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/admin_layout/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="72x72"
        href="{{ asset('assets/admin_layout/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('assets/admin_layout/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ asset('assets/admin_layout/img/apple-touch-icon-144x144-precomposed.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @include('admin.partials.styles')
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    @include('admin.partials.navbar')

    {{-- @include('admin.partials.sidebar') --}}



    <div class="content-wrapper">
        <div class="container-fluid">
            @include('admin.partials.breadcrumbs')
            {{ $slot }}
        </div>
        @include('admin.partials.footer')


        @include('admin.partials.scripts')
       
</body>

</html>
