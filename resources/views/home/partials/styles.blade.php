<!-- Favicons -->
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon-57x57-precomposed.png') }}" sizes="57x57">
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon-72x72-precomposed.png') }}" sizes="72x72">
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon-114x114-precomposed.png') }}" sizes="114x114">
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon-144x144-precomposed.png') }}" sizes="144x144">

<!-- Google Web Font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Base CSS -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

<!-- Revolution Slider CSS -->
<link href="{{ asset('assets/revolution-slider/css/settings.css') }}" rel="stylesheet">
<link href="{{ asset('assets/revolution-slider/css/layers.css') }}" rel="stylesheet">
<link href="{{ asset('assets/revolution-slider/css/navigation.css') }}" rel="stylesheet">
<link href="{{ asset('assets/revolution-slider/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

<!-- Specific CSS -->
<link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

<!-- Revolution Slider Custom CSS -->
<style>
    .tiny_bullet_slider .tp-bullet:before {
        content: " ";
        position: absolute;
        width: 100%;
        height: 25px;
        top: -12px;
        left: 0px;
        background: transparent;
    }
    .bullet-bar.tp-bullets:before {
        content: " ";
        position: absolute;
        width: 100%;
        height: 100%;
        background: transparent;
        padding: 10px;
        margin-left: -10px;
        margin-top: -10px;
        box-sizing: content-box;
    }
    .bullet-bar .tp-bullet {
        width: 60px;
        height: 3px;
        position: absolute;
        background: #aaa;
        background: rgba(204, 204, 204, 0.5);
        cursor: pointer;
        box-sizing: content-box;
    }
    .bullet-bar .tp-bullet:hover,
    .bullet-bar .tp-bullet.selected {
        background: rgba(204, 204, 204, 1);
    }
</style>
